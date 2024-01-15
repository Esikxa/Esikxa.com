<?php

namespace App\Http\Controllers\Frontend\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('frontend.teacher.pages.dashboard');
    }
}
