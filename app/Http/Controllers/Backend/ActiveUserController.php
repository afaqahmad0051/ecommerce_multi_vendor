<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ActiveUserController extends Controller
{
    public function customerList()
    {
        $users = User::where('role','user')->latest()->get();
        return view('admin.users.customer_list',compact('users'));
    }

    public function vendorList()
    {
        $users = User::where('role','vendor')->latest()->get();
        return view('admin.users.vendor_list',compact('users'));
    }

    public function AdminList()
    {
        $admins = User::where('role','admin')->latest()->get();
        return view('admin.users.admin_user.list',compact('admins'));
    }

    public function AdminCreate()
    {
        $roles = Role::all();
        return view('admin.users.admin_user.create',compact('roles'));
    }

    public function AdminStore(Request $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();
        if ($request->role_id) {
            $user->assignRole($request->role_id);
        }
        $notification = array(
            'message' => 'Account created',
            'alert-type' => 'success'
        );
        return redirect()->route('user.admin.list')->with($notification);
    }

    public function AdminEdit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.admin_user.edit',compact('user','roles'));
    }

    public function AdminUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->role_id) {
            $user->assignRole($request->role_id);
        }
        $notification = array(
            'message' => 'Account updated',
            'alert-type' => 'success'
        );
        return redirect()->route('user.admin.list')->with($notification);
    }

    public function AdminDelete($id)
    {
        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }
        $notification = array(
            'message' => 'Account Deleted',
            'alert-type' => 'success'
        );
        return redirect()->route('user.admin.list')->with($notification);
    }
}
