<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutStat;
use App\Models\AboutStep;
use App\Models\AboutValue;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();

        $stats = AboutStat::orderBy('order')->get();
  
        return view('pages.about', compact('about','stats'));
    }
}
