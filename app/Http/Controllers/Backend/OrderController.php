<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        $orders = Order::where('status','pending')->latest()->get();
        return view('admin.order.pending',compact('orders'));
    }
    
    public function confirm()
    {
        $orders = Order::where('status','confirm')->latest()->get();
        return view('admin.order.confirm',compact('orders'));
    }
    
    public function processing()
    {
        $orders = Order::where('status','processing')->latest()->get();
        return view('admin.order.processing',compact('orders'));
    }
    
    public function delivered()
    {
        $orders = Order::where('status','delivered')->latest()->get();
        return view('admin.order.delivered',compact('orders'));
    }

    public function details($id)
    {
        $data['order'] = Order::with('country','city','area','user')->where('id',$id)->first();
        $data['order_item'] = OrderItem::with('product')->where('order_id',$id)->latest()->get();
        return view('admin.order.order_view',compact('data'));
    }

    public function PendingConfirm($id)
    {
        $data['order'] = Order::findOrFail($id)->update([
            'status' => 'confirm',
        ]);
        $notification = array(
            'message' => 'Order Confirmed',
            'alert-type' => 'success'
        );
        return redirect()->route('order.confirm')->with($notification);
    }

    public function ConfirmProcessing($id)
    {
        $data['order'] = Order::findOrFail($id)->update([
            'status' => 'processing',
        ]);
        $notification = array(
            'message' => 'Order Processing',
            'alert-type' => 'success'
        );
        return redirect()->route('order.processing')->with($notification);
    }

    public function ProcessingDeliver($id)
    {
        $product = OrderItem::where('order_id',$id)->get();
        foreach ($product as $item) {
            Product::where('id',$item->product_id)->update([
                'product_qty' => DB::raw('product_qty-'.$item->qty)
            ]);
        }
        $data['order'] = Order::findOrFail($id)->update([
            'status' => 'delivered',
        ]);
        $notification = array(
            'message' => 'Order delivered',
            'alert-type' => 'success'
        );
        return redirect()->route('order.delivered')->with($notification);
    }

    public function invoice($id)
    {
        // $order = Order::with('country','city','area','user')->where('id',$id)->first();
        // $order_item = OrderItem::with('product')->where('order_id',$id)->latest()->get();
        // $pdf = Pdf::loadView('user.order.order_pdf', compact('order','order_item'))->setPaper('a4')->setOption([
        //     'tempDir' => public_path(),
        //     'chroot' => public_path(),
        // ]);
        // return $pdf->download('invoice.pdf');

        $data['order'] = Order::with('country','city','area','user')->where('id',$id)->first();
        $data['order_item'] = OrderItem::with('product')->where('order_id',$id)->latest()->get();
        return view('admin.order.order_pdf',compact('data'));
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
