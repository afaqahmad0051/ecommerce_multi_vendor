<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function Dashboard()
    {
        $role = Auth::user()->role;
        if ($role == 'user') {
            $id = Auth::user()->id;
            $userData = User::find($id);
            return view('index',compact('userData'));            
        }
        else{
            abort(404);
        }
    }

    public function ProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Profile Updated',
            'alert-type' => 'success'        
        );
        return redirect()->back()->with($notification);
    }

    public function Logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logged out',
            'alert-type' => 'error'        
        );
        return redirect('/login')->with($notification);
    }

    public function ChangePassword(Request $request)
    {
        $role = Auth::user()->role;
        if ($role == 'user') {
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
                return redirect('/login')->with($notification);
            }else{
                // Session()->flash('message','Credentials do not match our records');
                $notification = array(
                    'message' => 'Credentials do not match our records',
                    'alert-type' => 'error'        
                );
                return redirect()->back()->with($notification);
            }
        }
        else{
            abort(404);
        }

    }
}
