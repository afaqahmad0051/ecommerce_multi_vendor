<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AllUserController extends Controller
{
    public function UserAccount()
    {
        $role = Auth::user()->role;
        if ($role == 'user') {
            $id = Auth::user()->id;
            $userData = User::find($id);
            return view('user.account.profile',compact('userData'));
        }
        else{
            abort(404);
        }
    }
    
    public function UserPassword()
    {
        return view('user.account.password');
    }

    public function UserOrders()
    {
        $role = Auth::user()->role;
        if ($role == 'user') {
            $id = Auth::user()->id;
            $orders = Order::where('user_id',$id)->latest()->get();
            return view('user.account.order',compact('orders'));
        }
        else{
            abort(404);
        }
    }

    public function UserReturnOrders()
    {
        $role = Auth::user()->role;
        if ($role == 'user') {
            $id = Auth::user()->id;
            $orders = Order::where('user_id',$id)->where('return_reason','!=',null)->latest()->get();
            return view('user.account.return',compact('orders'));
        }
        else{
            abort(404);
        }
    }

    public function orderview($id)
    {
        $role = Auth::user()->role;
        if ($role == 'user') {
            $user_id = Auth::user()->id;
            $data['order'] = Order::with('country','city','area','user')->where('id',$id)->where('user_id',$user_id)->first();
            $data['order_item'] = OrderItem::with('product')->where('order_id',$id)->latest()->get();
            return view('user.order.order_view',compact('data'));
        }
    }

    public function orderpdf($id)
    {
        $role = Auth::user()->role;
        if ($role == 'user') {
            $user_id = Auth::user()->id;
            // $order = Order::with('country','city','area','user')->where('id',$id)->where('user_id',$user_id)->first();
            // $order_item = OrderItem::with('product')->where('order_id',$id)->latest()->get();
            // $pdf = Pdf::loadView('user.order.order_pdf', compact('order','order_item'))->setPaper('a4')->setOption([
            //     'tempDir' => public_path(),
            //     'chroot' => public_path(),
            // ]);
            // return $pdf->download('invoice.pdf');

            $data['order'] = Order::with('country','city','area','user')->where('id',$id)->where('user_id',$user_id)->first();
            $data['order_item'] = OrderItem::with('product')->where('order_id',$id)->latest()->get();
            return view('user.order.order_invoice',compact('data'));
        }
    }

    public function orderreturn(Request $request, $id)
    {
        Order::findOrFail($id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' =>  1,
        ]);
        $notification = array(
            'message' => 'Order return requested',
            'alert-type' => 'warning'
        );
        return redirect()->route('user.account.orders')->with($notification);
    }
}
