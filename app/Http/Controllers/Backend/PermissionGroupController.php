<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PermissionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $groups = PermissionGroup::get();
        return view('admin.setting.permission_group.list',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setting.permission_group.create');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PermissionGroup::insert([
            'name' => $request->name,
            'status' => isset($request->status)?"1":"0",
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Group Inserted',
            'alert-type' => 'success'
        );
        return redirect()->route('permission-group.list')->with($notification);
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
        $group = PermissionGroup::findOrFail($id);
        return view('admin.setting.permission_group.edit',compact('group'));
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
        PermissionGroup::findOrFail($id)->update([
            'name' => $request->name,
            'status' => isset($request->status)?"1":"0",
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Group Updated',
            'alert-type' => 'success'
        );
        return redirect()->route('permission-group.list')->with($notification);
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
