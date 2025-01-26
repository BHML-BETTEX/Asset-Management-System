<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;





class UserController extends Controller
{
    function users()
    {
        $users = User::all();
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
        
        $user = User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            

        ]);

        $user->syncRoles($request->role);
        //return redirect()->route("users");
    }

    function users_delete($user_id)
    {
        User::find($user_id)->delete();
        return back()->with('delete', 'user deleteed success!');
    }

    function profile()
    {
        return view('admin.users.profile');
    }

    function name_change(Request $request)
    {
        User::find(Auth::id())->update([
            'name' => $request->name,
        ]);
        return back()->with('name', 'User Name Udate Successfull');
    }

    function password_change(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'confirm_password' => 'required',
        ]);
        if (Hash::check($request->old_password, Auth::user()->password)) {
            User::find(Auth::id())->Update([
                'password' => bcrypt($request->password),
            ]);

            return back()->with('success', 'Password has been Update!');
        } else {
            return back()->with('wrong', 'Password Not Correct!');
        }
    }
}
