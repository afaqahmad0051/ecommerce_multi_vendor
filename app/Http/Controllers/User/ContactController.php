<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function aboutus()
    {
        return view('user.layouts.about_us');
    }

    public function contactus()
    {
        return view('user.layouts.contact_us');
    }

}
