<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('tags')
            ->where('is_active', true)
            ->latest()
            ->get();

        $blogCount = $blogs->count();

        $categoryCount = $blogs
            ->pluck('main_tag')
            ->filter()
            ->unique()
            ->count();

        $groups = $blogs->groupBy('main_tag');

        return view('pages.blog', compact(
            'blogs',
            'blogCount',
            'categoryCount',
            'groups'
        ));
    }
}