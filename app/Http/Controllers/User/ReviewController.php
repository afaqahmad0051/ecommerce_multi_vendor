<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $product = $request->product_id;
        $vendor = $request->vendor_id;

        $request->validate([
            'comment' => 'required',
        ]);
        Review::insert([
            'product_id' => $product,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->quality,
            'vendor_id' => $vendor,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Review sent',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function reviewPending()
    {
        $reviews = Review::where('status',0)->latest()->get();
        return view('admin.review.pending',compact('reviews'));
    }

    public function reviewPublished()
    {
        $reviews = Review::where('status',1)->latest()->get();
        return view('admin.review.published',compact('reviews'));
    }

    public function reviewPublish($id)
    {
        Review::where('id',$id)->update([
            'status' => 1,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Review published',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function reviewDelete($id)
    {
        Review::where('id',$id)->delete();
        $notification = array(
            'message' => 'Review deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function AllreviewVendor()
    {
        
        $role = Auth::user()->role;
        if ($role == 'vendor') {
            $user_id = Auth::user()->id;
            $reviews = Review::where('vendor_id',$user_id)->where('status',1)->latest()->get();
            return view('vendor.review.vendor_review',compact('reviews'));
        }
    }
}