<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
}
