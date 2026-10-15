<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogPostController extends Controller
{
    public function index($id)
    {
        $blog = Blog::with('tags')
            ->where('is_active', true)
            ->findOrFail($id);

        $relatedBlogs = Blog::where('is_active', true)
            ->where('id', '!=', $blog->id)
            ->where('main_tag', $blog->main_tag)
            ->latest()
            ->take(3)
            ->get();

        if ($relatedBlogs->count() < 3) {
            $extraBlogs = Blog::where('is_active', true)
                ->where('id', '!=', $blog->id)
                ->whereNotIn('id', $relatedBlogs->pluck('id'))
                ->latest()
                ->take(3 - $relatedBlogs->count())
                ->get();

            $relatedBlogs = $relatedBlogs->merge($extraBlogs);
        }

        return view('pages.blog-post', compact(
            'blog',
            'relatedBlogs'
        ));
    }
}