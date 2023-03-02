<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        if (Auth::user()->role == 'vendor') {
            $vendor_id = Auth::id();
            $orderItem = OrderItem::with('order')->where('vendor_id',$vendor_id)->latest()->get();
            return view('vendor.order.pending',compact('orderItem'));
        }
    }

    public function return()
    {
        if (Auth::user()->role == 'vendor') {
            $vendor_id = Auth::id();
            $orderItem = OrderItem::with('order')->where('vendor_id',$vendor_id)->latest()->get();
            return view('vendor.order.return',compact('orderItem'));
        }
    }

    public function approve()
    {
        if (Auth::user()->role == 'vendor') {
            $vendor_id = Auth::id();
            $orderItem = OrderItem::with('order')->where('vendor_id',$vendor_id)->latest()->get();
            return view('vendor.order.approve',compact('orderItem'));
        }
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
