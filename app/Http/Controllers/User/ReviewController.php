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
}
