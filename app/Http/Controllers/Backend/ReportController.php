<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportView()
    {
        $users = User::where('role','user')->latest()->get();
        return view('admin.reports.view',compact('users'));
    }

    public function searchbyDate(Request $request)
    {
        $date = new DateTime($request->date);
        $format = $date->format('d F Y');

        $orders = Order::where('order_date',$format)->latest()->get();
        return view('admin.reports.date_report',compact('orders'));
    }

    public function searchbyMonth(Request $request)
    {
        $month = $request->month_name;
        $year = $request->year_name;

        $orders = Order::where('order_month',$month)->where('order_year',$year)->latest()->get();
        return view('admin.reports.month_report',compact('orders'));
    }

    public function searchbyYear(Request $request)
    {
        $year = $request->year;

        $orders = Order::where('order_year',$year)->latest()->get();
        return view('admin.reports.year_report',compact('orders'));
    }

    public function searchbyUser(Request $request)
    {
        $id = $request->user;

        $orders = Order::where('user_id',$id)->latest()->get();
        return view('admin.reports.user_report',compact('orders'));
    }
}
