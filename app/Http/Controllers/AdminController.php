<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogin()
    {
        return view('admin.admin_layouts.login');
    }

    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logged out',
            'alert-type' => 'error'        
        );
        return redirect()->route('admin.login')->with($notification);
    }
}
