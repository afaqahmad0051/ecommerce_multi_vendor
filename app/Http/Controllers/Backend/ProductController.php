<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.product_list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data['brands'] = Brand::where('status',1)->orderBy('brand_name','ASC')->get();
        $data['vendors'] = User::where('role','vendor')->where('status','active')->latest()->get();
        $data['categories'] = Category::where('status',1)->latest()->get();
        $data['subcategories'] = SubCategory::where('status',1)->latest()->get();
        return view('admin.product.create_form',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1100,1100)->save('upload/product/thumbnail/'.$name_gen);
        $save_url = 'upload/product/thumbnail/'.$name_gen;

        $subcategory_id = SubCategory::where('id', $request->subcategory_id)->first();
        $category = Category::where('id', $subcategory_id->category_id)->first();
        $category_id = $category->id;
        
        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $category_id,
            'subcategory_id' => $request->subcategory_id,
            'vendor_id' => $request->vendor_id,

            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,

            'product_tags' => $request->product_tags,
            'product_color' => $request->product_color,
            'product_size' => $request->product_size,
            'product_qty' => $request->product_qty,

            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'product_thumbnail' => isset($save_url)?$save_url:'',

            'hot_deals' => isset($request->hot_deals)?"1":"0",
            'featured' => isset($request->featured)?"1":"0",
            'special_offer' => isset($request->special_offer)?"1":"0",
            'special_deals' => isset($request->special_deals)?"1":"0",
            'status' => isset($request->status)?"1":"0",
            'created_at' => Carbon::now(),
        ]);
        //Multi Image Insert
        $images = $request->file('multi_img');
        foreach($images as $img)
        {
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(1100,1100)->save('upload/product/multiple/'.$make_name);
            $upload_path = 'upload/product/multiple/'.$make_name;
            
            ProductImage::insert([
                'product_id' => $product_id,
                'photo_name' => $upload_path,
                'created_at' => Carbon::now(),
            ]);
        }
        
        $notification = array(
            'message' => 'Product Inserted',
            'alert-type' => 'success'
        );
        return redirect()->route('product.list')->with($notification);
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
