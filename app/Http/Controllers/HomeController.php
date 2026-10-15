<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Blog;
use App\Models\Categories;
use App\Models\Process;
use App\Models\Products;
use App\Models\Service;
use App\Models\Why;

class HomeController extends Controller
{
    public function index()
    {
        $whys = Why::all();

        $processes = Process::orderBy('order')->get();

        $brands = Brand::all();

        $services = Service::with([
            'items.tags'
        ])->get();


        $products = Products::with('category')
            ->where('is_active', true)
            ->latest('id')
            ->take(9)
            ->get();

        $categories = Categories::whereNull('parent_id')
            ->whereHas('products', function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy('id')
            ->get();

        $blogs = Blog::where('is_active', true)
            ->latest('id')
            ->take(3)
            ->get();

        return view('pages.index', compact(
            'whys',
            'categories',
            'processes',
            'brands',
            'products',
            'blogs',
            'services'
        ));
    }
}