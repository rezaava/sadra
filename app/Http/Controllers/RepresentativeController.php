<?php

namespace App\Http\Controllers;

use App\Models\RepresentativeRequest;
use Illuminate\Http\Request;

class RepresentativeController extends Controller
{
    public function index()
    {
        return view('pages.representative');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255'],
            'type' => ['required', 'in:sales,online,regional,other'],
            'message' => ['nullable', 'string'],
        ]);

        RepresentativeRequest::create($validated);

        return redirect()
            ->route('representative')
            ->with('success', 'ممنون از علاقه‌تان به همکاری با صدرا. تیم ما درخواست شما را بررسی می‌کند و به‌زودی با شما تماس می‌گیرد.');
    }
}