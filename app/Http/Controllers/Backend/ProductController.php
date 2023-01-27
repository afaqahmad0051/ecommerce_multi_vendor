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
        $data['product'] = Product::findOrFail($id);
        $data['brands'] = Brand::where('status',1)->orderBy('brand_name','ASC')->get();
        $data['vendors'] = User::where('role','vendor')->where('status','active')->latest()->get();
        $data['categories'] = Category::where('status',1)->latest()->get();
        $data['subcategories'] = SubCategory::where('status',1)->latest()->get();
        $data['images'] = ProductImage::where('product_id',$id)->get();
        return view('admin.product.edit_form',compact('data'));
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
        $subcategory_id = SubCategory::where('id', $request->subcategory_id)->first();
        $category = Category::where('id', $subcategory_id->category_id)->first();
        $category_id = $category->id;
        
        $product_id = Product::findOrFail($id)->update([
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

            'hot_deals' => isset($request->hot_deals)?"1":"0",
            'featured' => isset($request->featured)?"1":"0",
            'special_offer' => isset($request->special_offer)?"1":"0",
            'special_deals' => isset($request->special_deals)?"1":"0",
            'status' => isset($request->status)?"1":"0",
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Updated without image',
            'alert-type' => 'success'
        );
        return redirect()->route('product.list')->with($notification);
    }

    public function updateImage(Request $request, $id)
    {
        $oldImg = $request->old_image;
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1100,1100)->save('upload/product/thumbnail/'.$name_gen);
        $save_url = 'upload/product/thumbnail/'.$name_gen;
        if (file_exists($oldImg)) {
            unlink($oldImg);
        }
        Product::findOrFail($id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Product Image Updated',
            'alert-type' => 'success'
        );
        return redirect()->route('product.list')->with($notification);
    }

    public function updateMultiImage(Request $request)
    {
        $imgs = $request->multi_img;
        foreach($imgs as $id => $img)
        {
            $imgDel = ProductImage::findOrFail($id);
            unlink($imgDel->photo_name);
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(1100,1100)->save('upload/product/multiple/'.$make_name);
            $upload_path = 'upload/product/multiple/'.$make_name;
            
            ProductImage::where('id',$id)->update([
                'photo_name' => $upload_path,
                'updated_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Product Image Updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function imagedestroy($id)
    {
        $oldImg = ProductImage::findOrFail($id);
        unlink($oldImg->photo_name);
        ProductImage::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Product Image Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function inactive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 0
        ]);
        $notification = array(
            'message' => 'Product Inactived',
            'alert-type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }

    public function active($id)
    {
        Product::findOrFail($id)->update([
            'status' => 1
        ]);
        $notification = array(
            'message' => 'Product Actived',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = ProductImage::where('product_id',$id)->get();
        foreach($images as $img)
        {
            unlink($img->photo_name);
            ProductImage::where('product_id',$id)->delete();
        }
        $notification = array(
            'message' => 'Product Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
