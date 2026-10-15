<?php

namespace App\Http\Controllers;

use App\Models\AdminVideo;

class IntroController extends Controller
{
    public function index()
    {
        $adminVideo = AdminVideo::first();

        if (!$adminVideo || !$adminVideo->video) {
            return redirect()->route('home');
        }

        return view('pages.intro', compact('adminVideo'));
    }
}