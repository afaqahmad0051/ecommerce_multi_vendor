<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::latest()->get();
        return view('admin.setting.banner.banner_list',compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setting.banner.create_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('photo');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
        $save_url = 'upload/banner/'.$name_gen;

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url,
            'status' => isset($request->status)?"1":"0",
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Banner Inserted',
            'alert-type' => 'success'
        );
        return redirect()->route('banner.list')->with($notification);
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
        $banner = Banner::findOrFail($id);
        return view('admin.setting.banner.edit_form',compact('banner'));
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
        $old_image = $request->old_image;
        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
            $save_url = 'upload/banner/'.$name_gen;
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            Banner::findOrFail($id)->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'banner_image' => $save_url,
                'status' => isset($request->status)?"1":"0",
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Banner Updated',
                'alert-type' => 'success'
            );
            return redirect()->route('banner.list')->with($notification);
        }else{
            Banner::findOrFail($id)->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'status' => isset($request->status)?"1":"0",
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Banner Updated',
                'alert-type' => 'success'
            );
            return redirect()->route('banner.list')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $img = $banner->banner_image;
        unlink($img);
    
        Banner::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Banner Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
