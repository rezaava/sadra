<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($id)
    {
        $product = Products::with(['category', 'features'])
            ->where('is_active', true)
            ->findOrFail($id);

        $relatedProducts = Products::with('category')
            ->where('is_active', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.product', compact('product', 'relatedProducts'));
    }
}