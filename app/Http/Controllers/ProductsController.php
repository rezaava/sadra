<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;

class ProductsController extends Controller
{
    public function index()
    {
        $categories = Categories::with([
            'products' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('id');
            }
        ])
            ->whereNull('parent_id')
            ->orderBy('id')
            ->get();

        $productsCount = Products::where('is_active', true)->count();

        $categoriesCount = $categories->count();
        $heroProducts = Products::whereNotNull('image')->latest()->take(3)->get();
        return view('pages.products', compact(
            'categories',
            'productsCount',
            'categoriesCount',
            'heroProducts'
        ));
    }
}