<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $area = Area::latest()->get();
        return view('admin.shipping.area.list',compact('area'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['country'] = Country::where('status',1)->orderBy('country_name','asc')->get();
        $data['city'] = City::where('status',1)->orderBy('city_name','asc')->get();
        return view('admin.shipping.area.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city_id = City::where('id', $request->city_id)->first();
        $country = Country::where('id', $city_id->country_id)->first();
        $country_id = $country->id;
        Area::insert([
            'country_id' => $country_id,
            'city_id' => $request->city_id,
            'area_name' => $request->area_name,
            'status' => isset($request->status)?"1":"0",
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Area Inserted',
            'alert-type' => 'success'
        );
        return redirect()->route('area.list')->with($notification);
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
        $data['country'] = Country::where('status',1)->get();
        $data['city'] = City::where('status',1)->get();
        $data['area'] = Area::findOrFail($id);
        return view('admin.shipping.area.edit',compact('data'));
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
        $city_id = City::where('id', $request->city_id)->first();
        $country = Country::where('id', $city_id->country_id)->first();
        $country_id = $country->id;
        Area::findOrFail($id)->update([
            'country_id' => $country_id,
            'city_id' => $request->city_id,
            'area_name' => $request->area_name,
            'status' => isset($request->status)?"1":"0",
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Area Updated',
            'alert-type' => 'success'
        );
        return redirect()->route('area.list')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Area::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Area Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}