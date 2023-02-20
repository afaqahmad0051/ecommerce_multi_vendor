<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Coupan;
use App\Models\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function cartdata(Request $request, $id)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
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
                    'vendor_id' => $request->vendor_id,
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
                    'vendor_id' => $request->vendor_id,
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
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
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
                    'vendor_id' => $request->vendor_id,
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
                    'vendor_id' => $request->vendor_id,
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
    public function show()
    {
        return view('user.cart.list');
    }
    public function GetCartData()
    {
        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_total = Cart::total();

        return response()->json([
            'cart' => $carts,
            'cartQty' => $cart_qty,
            'cartTotal' => $cart_total
        ]);
    }

    public function cartRemove($rowId)
    {
        Cart::remove($rowId);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupan::where('coupon_name',$coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round((Cart::total() * $coupon->coupon_discount)/100),
                'total_amount' => round(Cart::total() - (Cart::total() * $coupon->coupon_discount)/100),
            ]);
        }
        return response()->json(['success' => 'Product removed from cart']);
    }

    public function cartDecrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupan::where('coupon_name',$coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round((Cart::total() * $coupon->coupon_discount)/100),
                'total_amount' => round(Cart::total() - (Cart::total() * $coupon->coupon_discount)/100),
            ]);
        }
        return response()->json(['success' => 'Successfully']);
    }

    public function cartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupan::where('coupon_name',$coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round((Cart::total() * $coupon->coupon_discount)/100),
                'total_amount' => round(Cart::total() - (Cart::total() * $coupon->coupon_discount)/100),
            ]);
        }
        return response()->json(['success' => 'Successfully']);
    }

    public function coupon(Request $request)
    {
        $coupon = Coupan::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round((Cart::total() * $coupon->coupon_discount)/100),
                'total_amount' => round(Cart::total() - (Cart::total() * $coupon->coupon_discount)/100),
            ]);
            return response()->json([
                'validity' => true,
                'success' => 'Coupon applied successfully'
            ]);
        }else{
            return response()->json(['error' => 'Inavlid Coupon']);
        }
    }

    public function CouponCalculation()
    {
        if (Session::has('coupon')) {
            return response()->json([
                'subtotal' => Cart::total(),
                'coupon_name' => Session()->get('coupon')['coupon_name'],
                'coupon_discount' => Session()->get('coupon')['coupon_discount'],
                'discount_amount' => Session()->get('coupon')['discount_amount'],
                'total_amount' => Session()->get('coupon')['total_amount'],
            ]);
        }else{
            return response()->json([
                'total' => Cart::total(),
            ]);
        }
    }

    public function checkout()
    {
        if (Auth::check()) {
            if (Cart::total() > 0) {
                $data['carts'] = Cart::content();
                $data['cart_qty'] = Cart::count();
                $data['cart_total'] = Cart::total();

                $data['countries'] = Country::with('city')->where('status',1)->get();
                return view('user.checkout.list',compact('data'));
            }else{
                $notification = array(
                    'message' => 'Shop atleast one product to checkout',
                    'alert-type' => 'error'        
                );
                return redirect()->to('/')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Login required to checkout',
                'alert-type' => 'error'        
            );
            return redirect()->route('login')->with($notification);
        }
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
    public function destroy()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed']);
    }
}
