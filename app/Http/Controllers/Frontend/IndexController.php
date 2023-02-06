<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
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