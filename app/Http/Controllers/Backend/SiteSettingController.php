<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\SiteSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function edit($id = null)
    {
        $setting = SiteSetting::find(1);
        return view('admin.setting.site.site_info',compact('setting'));
    }

    public function seoedit($id = null)
    {
        $seo = Seo::find(1);
        return view('admin.setting.site.seo',compact('seo'));
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
        if ($request->file('logo')) {
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(180,56)->save('upload/logo/'.$name_gen);
            $save_url = 'upload/logo/'.$name_gen;
            if (file_exists($old_image)) {
                unlink($old_image);
            }
            SiteSetting::findOrFail($id)->update([
                'cell_phone' => $request->cell_phone,
                'support_phone' => $request->support_phone,
                'email' => $request->email,
                'slogan' => $request->slogan,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'address' => $request->address,
                'logo' => $save_url,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Settings Updated',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            SiteSetting::findOrFail($id)->update([
                'cell_phone' => $request->cell_phone,
                'support_phone' => $request->support_phone,
                'email' => $request->email,
                'slogan' => $request->slogan,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
                'address' => $request->address,
                'updated_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Settings Updated',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function seoupdate(Request $request, $id)
    {
        Seo::findOrFail($id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_descripiton' => $request->meta_descripiton,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'SEO Updated',
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
        //
    }
}
