<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReturnOrderController extends Controller
{
    public function orderReturn()
    {
        $orders = Order::where('return_order',1)->latest()->get();
        return view('admin.order.return.request',compact('orders'));
    }

    public function returnApprove($order_id)
    {
        Order::where('id',$order_id)->update([
            'return_order' => 2,
        ]);
        $notification = array(
            'message' => 'Return Approved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function orderReturncomplete()
    {
        $orders = Order::where('return_order',2)->latest()->get();
        return view('admin.order.return.approved',compact('orders'));
    }
}