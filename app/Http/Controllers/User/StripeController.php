<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Area;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\OrderComplete;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function stripeorder(Request $request)
    {
        
        $user = User::where('role','admin')->get();
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        }
        else{
            $total_amount = round(Cart::total());
        }
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51M434WLHUfosJYdWb82SP27BL52NgsVVfVOX6cfGP9JEI87XknuZ4SJ8C5HPidIBDBxtlgWg90PqTSdiHWMZhtfo00WCCjxVoQ');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total_amount*100,
            'currency' => 'gbp',
            'description' => 'Nest Mart & Grocery',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);
        // dd($charge);

        $role = Auth::user()->role;
        if ($role == 'user') {
            $user_id = Auth::id();
        }
        if(isset($request->area_id)){
            $area = Area::where('id', '=', $request->area_id)->with('country','city')->first();
            // dump($l_area);
            $city_id = $area->city->id;
            $country_id = $area->country->id;
        }else{
            $notification = array(
                'message' => 'Please select area',
                'alert-type' => 'error'
            );
            return redirect()->route('checkout')->with($notification);
        }
        $order_id = Order::insertGetId([
            'user_id' => $user_id,
            'country_id' => $country_id,
            'city_id' => $city_id,
            'area_id' => $request->area_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => $charge->payment_method,
            'payment_method' => 'stripe',
            'transaction_id' => $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,

            'order_number' => $charge->metadata->order_id,
            'invoice_no' => 'NMG'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),

            'status' => 'pending',
            'created_at' => Carbon::now(),
        ]);
        // Send Email 
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
            'phone' => $invoice->phone,
            'address' => $invoice->address,
        ];
        Mail::to($request->email)->send(new OrderMail($data));
        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor_id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        Cart::destroy();
        $notification = array(
            'message' => 'Order placed successfully',
            'alert-type' => 'success'
        );
        Notification::send($user, new OrderComplete($request->name));
        return redirect()->route('dashboard')->with($notification);
    }

    public function cashorder(Request $request)
    {
        $user = User::where('role','admin')->get();
        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        }
        else{
            $total_amount = round(Cart::total());
        }

        $role = Auth::user()->role;
        if ($role == 'user') {
            $user_id = Auth::id();
        }
        if(isset($request->area_id)){
            $area = Area::where('id', '=', $request->area_id)->with('country','city')->first();
            // dump($l_area);
            $city_id = $area->city->id;
            $country_id = $area->country->id;
        }else{
            $notification = array(
                'message' => 'Please select area',
                'alert-type' => 'error'
            );
            return redirect()->route('checkout')->with($notification);
        }
        $order_id = Order::insertGetId([
            'user_id' => $user_id,
            'country_id' => $country_id,
            'city_id' => $city_id,
            'area_id' => $request->area_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,

            'payment_type' => 'COD',
            'payment_method' => 'Cash on delivery',
            'transaction_id' => 0,
            'currency' => 'gbp',
            'amount' => $total_amount,

            'order_number' => 0,
            'invoice_no' => 'NMG'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),

            'status' => 'pending',
            'created_at' => Carbon::now(),
        ]);
        // Send Email 
        $invoice = Order::findOrFail($order_id);
        $data = [
            'invoice_no' => $invoice->invoice_no,
            'amount' => $total_amount,
            'name' => $invoice->name,
            'email' => $invoice->email,
            'phone' => $invoice->phone,
            'address' => $invoice->address,
        ];
        Mail::to($request->email)->send(new OrderMail($data));
        $carts = Cart::content();
        foreach ($carts as $cart) {
            OrderItem::insert([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor_id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),
            ]);
        }
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        Cart::destroy();
        $notification = array(
            'message' => 'Order placed successfully',
            'alert-type' => 'success'
        );
        Notification::send($user, new OrderComplete($request->name));
        return redirect()->route('dashboard')->with($notification);
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
