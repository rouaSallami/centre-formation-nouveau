<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.page.index');
    }

    public function about()
    {
        return view('front.page.about');
    }

    public function course()
    {
        return view('front.page.course');
    }

    public function contact()
    {
        return view('front.page.contact');
    }

    public function team()
    {
        return view('front.page.team');
    }

    public function testimonial()
    {
        return view('front.page.testimonial');
    }
}