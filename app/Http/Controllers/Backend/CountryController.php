<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country = Country::latest()->get();
        return view('admin.shipping.country.list',compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Country::insert([
            'country_name' => $request->country_name,
            'status' => isset($request->status)?"1":"0",
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Country Inserted',
            'alert-type' => 'success'
        );
        return redirect()->route('country.list')->with($notification);
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
        $country = Country::findOrFail($id);
        return view('admin.shipping.country.edit',compact('country'));
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
        Country::findOrFail($id)->update([
            'country_name' => $request->country_name,
            'status' => isset($request->status)?"1":"0",
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Country Updated',
            'alert-type' => 'success'
        );
        return redirect()->route('country.list')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::where('country_id',$id)->first();
        $area = Area::where('country_id',$id)->first();
        if ($city || $area) {
            $notification = array(
                'message' => 'Cannot delete parent country',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        else {
            Country::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Country Deleted',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
}
