<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::latest()->get();
        return view('admin.setting.slider.slider_list',compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setting.slider.create_form');
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
        Image::make($image)->resize(2376,807)->save('upload/slider/'.$name_gen);
        $save_url = 'upload/slider/'.$name_gen;

        Slider::insert([
            'slider_title' => $request->slider_title,
            'slider_short_title' => $request->slider_short_title,
            'slider_image' => $save_url,
            'status' => isset($request->status)?"1":"0",
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Slider Inserted',
            'alert-type' => 'success'
        );
        return redirect()->route('slider.list')->with($notification);
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
        $slider = Slider::findOrFail($id);
        return view('admin.setting.slider.edit_form',compact('slider'));
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
            Image::make($image)->resize(2376,807)->save('upload/slider/'.$name_gen);
            $save_url = 'upload/slider/'.$name_gen;
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            Slider::findOrFail($id)->update([
                'slider_title' => $request->slider_title,
                'slider_short_title' => $request->slider_short_title,
                'slider_image' => $save_url,
                'status' => isset($request->status)?"1":"0",
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Slider Updated',
                'alert-type' => 'success'
            );
            return redirect()->route('slider.list')->with($notification);
        }else{
            Slider::findOrFail($id)->update([
                'slider_title' => $request->slider_title,
                'slider_short_title' => $request->slider_short_title,
                'status' => isset($request->status)?"1":"0",
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Slider Updated',
                'alert-type' => 'success'
            );
            return redirect()->route('slider.list')->with($notification);
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
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        unlink($img);
    
        Slider::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Slider Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
