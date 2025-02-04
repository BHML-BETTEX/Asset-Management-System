<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $role;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->role = auth()->user()->roles[0];
            return $next($request);
        });
    }
    
    public function roles()
    {   
        $roles = Role::all();
        return view("admin.roles.index", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roles_create()
    {
        $permission = permission::all();
        return view("admin.roles.create", compact("permission"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function roles_store(Request $request)
    {   
         $role = Role::create(["name"=>$request->name]);
         $role->syncPermissions($request->permision);
         return redirect()->route("roles.index")
                         ->with("season", "Role Created!");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = permission::all();
        return view("admin.roles.role_edit", compact("role", "permission"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function roles_update(Request $request, $id)
    {

       $role = Role::find($id);
       $role->name=$request->name;
       $role->save();
       $role->syncPermissions($request->permision);

       return redirect()->route("roles.index")
       ->with("season", "Role Updated!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role -> delete();

        return back();
    }
}
