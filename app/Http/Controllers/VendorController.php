<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{
    public function VendorDashboard()
    {
        return view('vendor.index');
    }

    public function VendorLogin()
    {
        return view('vendor.vendor_layouts.login');
    }

    public function VendorDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logged out',
            'alert-type' => 'error'        
        );
        return redirect()->route('vendor.login')->with($notification);
    }
    
    public function VendorProfile()
    {
        $role = Auth::user()->role;
        if ($role == 'vendor') {
            $id = Auth::user()->id;
            $vendorData = User::find($id);
            return view('vendor.profile.profile_edit',compact('vendorData'));
        }
        else{
            abort(404);
        }
    }

    public function VendorProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->starting_year = $request->starting_year;
        $data->vendor_short_info = $request->vendor_short_info;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Profile Updated',
            'alert-type' => 'success'        
        );
        return redirect()->back()->with($notification);
    }

    public function ChangePassword()
    {
        return view('vendor.profile.password');
    }

    public function UpdatePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword'=>'required',
            'newpassword'=>'required',
            'confirm_password'=>'required|same:newpassword'
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword)) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            // Session()->flash('message','Password Updated');            
            Session::flush();
            Auth::logout();
            $notification = array(
                'message' => 'Password Updated',
                'alert-type' => 'success'        
            );
            return redirect()->route('vendor.login')->with($notification);
        }else{
            // Session()->flash('message','Credentials do not match our records');
            $notification = array(
                'message' => 'Credentials do not match our records',
                'alert-type' => 'error'        
            );
            return redirect()->back()->with($notification);
        }
    }
}
