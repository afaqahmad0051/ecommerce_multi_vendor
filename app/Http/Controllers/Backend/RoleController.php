<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.role_permissions.permissions.list',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = PermissionGroup::where('status',1)->get();
        return view('admin.role_permissions.permissions.create',compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = Permission::create([
            'group_id' => $request->group_id,
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Permission Inserted',
            'alert-type' => 'success'
        );
        // return redirect()->back()->with($notification);
        return redirect()->route('permission.list')->with($notification);
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
        $groups = PermissionGroup::where('status',1)->get();
        $permission = Permission::findOrFail($id);
        return view('admin.role_permissions.permissions.edit',compact('groups','permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id)->update([
            'group_id' => $request->group_id,
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Permission updated',
            'alert-type' => 'success'
        );
        // return redirect()->back()->with($notification);
        return redirect()->route('permission.list')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Permission Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Roles Routes 
    public function roleindex()
    {
        $roles = Role::all();
        return view('admin.role_permissions.roles.list',compact('roles'));
    }

    public function rolecreate()
    {
        // $groups = PermissionGroup::where('status',1)->get();
        return view('admin.role_permissions.roles.create');
    }

    public function rolestore(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Role Inserted',
            'alert-type' => 'success'
        );
        // return redirect()->back()->with($notification);
        return redirect()->route('permission.role.list')->with($notification);
    }

    public function roleedit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role_permissions.roles.edit',compact('role'));
    }

    public function roleupdate(Request $request, $id)
    {
        $role = Role::findOrFail($id)->update([
            'name' => $request->name,
        ]);
        $notification = array(
            'message' => 'Role updated',
            'alert-type' => 'success'
        );
        // return redirect()->back()->with($notification);
        return redirect()->route('permission.role.list')->with($notification);
    }

    public function roledestroy($id)
    {
        Role::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Role Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    //Assign Permissions to user role
    public function assignRolePermission()
    {
        $data['permissions'] = Permission::all();
        $data['roles'] = Role::all();
        $data['permission_groups'] = User::permissionGroups();
        return view('admin.role_permissions.roles.assign_role_permissions',compact('data'));
    }

    public function storeRolePermission(Request $request)
    {
        $data = [];
        $permissions = $request->permission;
        foreach ($permissions as $key => $value) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $value;
            DB::table('role_has_permissions')->insert($data);
        }
        $notification = array(
            'message' => 'successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('permission.assign.list')->with($notification);
    }

    public function ListRolePermission()
    {
        $roles = Role::all();
        return view('admin.role_permissions.roles.assign_role_list',compact('roles'));
    }

    public function EditRolePermission($id)
    {
        $data['role'] = Role::findOrFail($id);
        $data['perms'] = Permission::all();
        $data['permission_group'] = User::permissionGroups();
        return view('admin.role_permissions.roles.assign_role_edit',compact('data'));
    }

    public function updateRolePermission(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permission;
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        $notification = array(
            'message' => 'successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('permission.assign.list')->with($notification);
    }

    public function DeleteRolePermission($id)
    {
        $role = Role::findOrFail($id);
        if (!is_null($role)) {
            $role->delete();
        }
        $notification = array(
            'message' => 'successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}