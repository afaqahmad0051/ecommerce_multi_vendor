<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug, $id)
    {
        $data['product'] = Product::where('id',$id)->where('status',1)->first();
        $product_color = $data['product']->product_color;
        $data['color'] = explode(',',$product_color);

        $product_size = $data['product']->product_size;
        $data['size'] = explode(',',$product_size);
        $data['multiImage'] = ProductImage::where('product_id',$id)->get();
        $category_id = $data['product']->category_id;
        $data['related_product'] = Product::where('category_id',$category_id)->where('id','!=',$id)->latest()->limit(4)->get();
        return view('user.product.product_details',compact('data'));
    }

    public function Home()
    {
        $data['cat_first'] = Category::where('status',1)->skip(0)->first();
        $data['pro_first'] = Product::where('status',1)->where('category_id',$data['cat_first']->id)->latest()->limit(5)->get();
        $data['cat_second'] = Category::where('status',1)->skip(1)->first();
        $data['pro_second'] = Product::where('status',1)->where('category_id',$data['cat_second']->id)->latest()->limit(5)->get();
        $data['cat_third'] = Category::where('status',1)->skip(9)->first();
        $data['pro_third'] = Product::where('status',1)->where('category_id',$data['cat_third']->id)->latest()->limit(5)->get();
        
        $data['hot_deals'] = Product::where('status',1)->where('hot_deals',1)->where('discount_price', '!=' , 0)->latest()->limit(3)->get();
        $data['special_offer'] = Product::where('status',1)->where('special_offer',1)->latest()->limit(3)->get();
        $data['recently_added'] = Product::where('status',1)->latest()->limit(3)->get();
        $data['special_deals'] = Product::where('status',1)->where('special_deals',1)->latest()->limit(3)->get();
        return view('user.index',compact('data'));
    }

    public function VendorDetails($id)
    {
        $data['vendor'] = User::where('id',$id)->where('role','vendor')->where('status','active')->first();
        $data['vProduct'] = Product::where('vendor_id',$id)->where('status',1)->get();
        return view('user.vendor.vendor_details',compact('data'));
    }

    public function List()
    {
        $data['vendors'] = User::where('status','active')->where('role','vendor')->latest()->get();
        return view('user.vendor.vendor_list',compact('data'));
    }

    public function category(Request $request, $slug, $id)
    {
        $data['product'] = Product::where('status',1)->where('category_id',$id)->latest()->get();
        $data['categories'] = Category::orderBy('category_name','asc')->get();
        $data['bread_cat'] = Category::where('id',$id)->first();
        $data['new_product'] = Product::where('status',1)->where('category_id',$id)->latest()->limit(3)->get();
        return view('user.product.product_category',compact('data'));
    }

    public function subcategory(Request $request, $slug, $id)
    {
        $data['product'] = Product::where('status',1)->where('subcategory_id',$id)->latest()->get();
        $data['categories'] = Category::orderBy('category_name','asc')->get();
        $data['bread_subcat'] = SubCategory::where('id',$id)->first();
        $data['new_product'] = Product::where('status',1)->where('subcategory_id',$id)->latest()->limit(3)->get();
        return view('user.product.product_subcategory',compact('data'));
    }

    public function quickview($id)
    {
        $data['product'] = Product::with('brand','category')->where('id',$id)->first();
        $product_color = $data['product']->product_color;
        $data['color'] = explode(',',$product_color);

        $product_size = $data['product']->product_size;
        $data['size'] = explode(',',$product_size);
        return response()->json([
            'product' => $data['product'],
            'color' => $data['color'],
            'size' => $data['size'],
        ]);   
    }

    public function userbargain(Request $request, $id)
    {
        $user_bargain = $request->user_offer;

        $data['product'] = Product::where('id',$id)->first();
        $product_price = $data['product']->selling_price;

        $final_per = ($product_price * 18)/100;
        $final_price = $product_price - $final_per;

        if ($user_bargain >= $final_price && $user_bargain <= $product_price) {
            return response()->json(['amount'=>$user_bargain,'success'=>'Successfully bargained']);
        }
        elseif($user_bargain < $final_price && !empty($user_bargain)){
            return response()->json(['amount'=>$final_price,'error'=>'Minimum amount is '.$final_price]);
        }elseif($user_bargain > $product_price){
            return response()->json(['amount'=>$product_price,'error'=>'Product amount exceeded']);
        }
    }

    public function Detailuserbargain(Request $request, $id)
    {
        $user_bargain = $request->user_offer;

        $data['product'] = Product::where('id',$id)->first();
        $product_price = $data['product']->selling_price;

        $final_per = ($product_price * 18)/100;
        $final_price = $product_price - $final_per;

        if ($user_bargain >= $final_price && $user_bargain <= $product_price) {
            return response()->json(['amount'=>$user_bargain,'success'=>'Successfully bargained']);
        }
        elseif($user_bargain < $final_price && !empty($user_bargain)){
            return response()->json(['amount'=>$final_price,'error'=>'Minimum amount is '.$final_price]);
        }elseif($user_bargain > $product_price){
            return response()->json(['amount'=>$product_price,'error'=>'Product amount exceeded']);
        }
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
