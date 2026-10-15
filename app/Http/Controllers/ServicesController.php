<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServicesController extends Controller
{
    public function index($id)
    {
        $service = Service::with([
            'items.tags'
        ])->findOrFail($id);

        return view('pages.services', compact('service'));
    }
}