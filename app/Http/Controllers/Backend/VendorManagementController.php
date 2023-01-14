<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VendorManagementController extends Controller
{
    public function InActive()
    {
        $InactiveVendor = User::where('role','vendor')->where('status','inactive')->latest()->get();
        return view('admin.vendor_management.inactive_vendor',compact('InactiveVendor'));
    }

    public function Active()
    {
        $ActiveVendor = User::where('role','vendor')->where('status','active')->latest()->get();
        return view('admin.vendor_management.active_vendor',compact('ActiveVendor'));
    }

    public function Details($id)
    {
        $details = User::findOrFail($id);
        $year = Year::latest()->get();
        return view('admin.vendor_management.vendor_details',compact('details','year'));
    }

    public function Approve(Request $request, $id)
    {
        $inactive = User::findOrfail($id)->update([
            'status' => 'active',
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Vendor Activated',
            'alert-type' => 'success'
        );
        return redirect()->route('vendor.inactive')->with($notification);
    }

    public function Deactivate(Request $request, $id)
    {
        $inactive = User::findOrfail($id)->update([
            'status' => 'inactive',
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Vendor Deactivated',
            'alert-type' => 'error'
        );
        return redirect()->route('vendor.active')->with($notification);
    }
}
