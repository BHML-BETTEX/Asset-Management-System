<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;




class UserController extends Controller
{
    function users(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->latest()->get();
        $total_user = User::count();
        return view('admin.users.users_list', compact('users', 'total_user'));
    }

    function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create', [
            'roles' => $roles,
        ]);
    }

    function users_store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8', // Ensure password confirmation is checked
            'role' => 'required'
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        
        try {
            DB::transaction(function () use($request) {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                // dd($request->role);
                $user->syncRoles($request->role); 
            });
            return redirect()->route("users");
            //code...
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    function users_delete($user_id)
    {
        try {
            $user = User::find($user_id);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ], 404);
            }

            // Delete profile photo if exists
            if ($user->profile_photo && file_exists(public_path('uploads/profile_photos/' . $user->profile_photo))) {
                unlink(public_path('uploads/profile_photos/' . $user->profile_photo));
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting user: ' . $e->getMessage()
            ], 500);
        }
    }

    function users_view($user_id)
    {
        try {
            $user = User::with('roles')->find($user_id);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ], 404);
            }

            $html = view('admin.users.partials.user_view', compact('user'))->render();

            return response()->json([
                'success' => true,
                'html' => $html
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading user details.'
            ], 500);
        }
    }

    function users_edit($user_id)
    {
        try {
            $user = User::with('roles')->find($user_id);
            $roles = Role::pluck('name','name')->all();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ], 404);
            }

            $html = view('admin.users.partials.user_edit', compact('user', 'roles'))->render();

            return response()->json([
                'success' => true,
                'html' => $html
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading edit form.'
            ], 500);
        }
    }

    function users_update(Request $request, $user_id)
    {
        try {
            $user = User::find($user_id);
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user_id,
                'password' => 'nullable|min:8',
                'role' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::transaction(function () use($request, $user) {
                $updateData = [
                    'name' => $request->name,
                    'email' => $request->email,
                ];

                // Only update password if provided
                if ($request->filled('password')) {
                    $updateData['password'] = Hash::make($request->password);
                }

                $user->update($updateData);
                $user->syncRoles($request->role);
            });

            return response()->json([
                'success' => true,
                'message' => 'User updated successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating user: ' . $e->getMessage()
            ], 500);
        }
    }

    function profile()
    {
        return view('admin.users.profile');
    }

    function name_change(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|min:2',
        ]);

        User::find(Auth::id())->update([
            'name' => $request->name,
        ]);
        return back()->with('name', 'User Name Updated Successfully');
    }

    function password_change(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'confirm_password' => 'required|same:new_password',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with('wrong', 'Current password is incorrect!');
        }

        User::find(Auth::id())->update([
            'password' => bcrypt($request->new_password),
        ]);

        return back()->with('success', 'Password has been updated successfully!');
    }

    function profile_photo_change(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::find(Auth::id());

        // Delete old profile photo if exists
        if ($user->profile_photo && file_exists(public_path('uploads/profile_photos/' . $user->profile_photo))) {
            unlink(public_path('uploads/profile_photos/' . $user->profile_photo));
        }

        // Upload new profile photo
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = 'profile_' . Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();

            // Create directory if not exists
            $uploadPath = public_path('uploads/profile_photos');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $file->move($uploadPath, $filename);

            $user->update([
                'profile_photo' => $filename,
            ]);
        }

        return back()->with('photo_success', 'Profile photo updated successfully!');
    }

    public function export(Request $request) 
    {
        if($request->type == "xlsx"){
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }
        elseif($request->type == "csv"){
            $extension = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        }
        elseif($request->type == "xls"){
            $extension = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        }
        else{
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;

        }
        

        $Filename = "users.$extension";
        return Excel::download(new UserExport, $Filename, $exportFormat);
    }
}
