<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $city = City::latest()->get();
        return view('admin.shipping.city.list',compact('city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = Country::where('status',1)->orderBy('country_name','asc')->get();
        return view('admin.shipping.city.create',compact('country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        City::insert([
            'country_id' => $request->country_id,
            'city_name' => $request->city_name,
            'status' => isset($request->status)?"1":"0",
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'City Inserted',
            'alert-type' => 'success'
        );
        return redirect()->route('city.list')->with($notification);
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
        $data['city'] = City::findOrFail($id);
        return view('admin.shipping.city.edit',compact('data'));
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
        City::findOrFail($id)->update([
            'country_id' => $request->country_id,
            'city_name' => $request->city_name,
            'status' => isset($request->status)?"1":"0",
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'City Updated',
            'alert-type' => 'success'
        );
        return redirect()->route('city.list')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::where('city_id',$id)->first();
        if ($area) {
            $notification = array(
                'message' => 'Cannot delete parent city',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        else {
        City::findOrFail($id)->delete();
        $notification = array(
            'message' => 'City Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        }
    }
}