<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function cartdata(Request $request, $id)
    {
        $data['product'] = Product::where('id',$id)->first();
        if($data['product']->discount_price == null)
        {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => isset($request->user_offer)?$request->user_offer:$data['product']->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $data['product']->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,                    
                ],
            ]);
            return response()->json(['success'=>'Add to cart successfully']);
        }
        else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $data['product']->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $data['product']->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,                    
                ],
            ]);
            return response()->json(['success'=>'Add to cart successfully']);
        }
    }

    public function minicart(){
        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_total = Cart::total();

        return response()->json([
            'cart' => $carts,
            'cartQty' => $cart_qty,
            'cartTotal' => $cart_total
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function removeminicart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product removed from cart']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cartdetail(Request $request, $id)
    {
        $data['product'] = Product::where('id',$id)->first();
        if($data['product']->discount_price == null)
        {
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => isset($request->user_offer)?$request->user_offer:$data['product']->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $data['product']->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,                    
                ],
            ]);
            return response()->json(['success'=>'Add to cart successfully']);
        }
        else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $data['product']->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $data['product']->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,                    
                ],
            ]);
            return response()->json(['success'=>'Add to cart successfully']);
        }
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
