<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.compare.list');
    }

    public function compare()
    {
        $user = Auth::user();
        $compare = Compare::with('product')->where('user_id',$user->id)->latest()->get();
        $count = $compare->count();
        return response()->json([
            'compare' => $compare,
            'count' => $count,
        ]);
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
    public function store(Request $request, $product_id)
    {
        if(Auth::check())
        {
            $user = Auth::user();
            if($user->role == 'user')
            {
                $exists = Compare::where('user_id',$user->id)->where('product_id',$product_id)->first();
                if(!$exists)
                {
                    Compare::insert([
                        'user_id' => $user->id,
                        'product_id' => $product_id,
                        'created_at' => Carbon::now(),
                    ]);
                    return response()->json(['success' => 'Product added to compare']);
                }
                else
                {
                    return response()->json(['error' => 'Already in compare']);
                }
            }
            else
            {
                return response()->json(['error' => 'Authentication Error']);
            }
        }
        else
        {
            return response()->json(['error' => 'Login required to add compare']);
        }
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
        $user = Auth::user();
        Compare::where('user_id',$user->id)->where('id',$id)->delete();
        return response()->json([
            'success' => 'Removed from compare',
        ]);
    }
}
