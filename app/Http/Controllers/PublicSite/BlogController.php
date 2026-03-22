<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::all();
        $categorySlug = request('category');

        $posts = BlogPost::published()
            ->with('category')
            ->when($categorySlug, fn ($q) => $q->whereHas('category', fn ($q2) => $q2->where('slug', $categorySlug)))
            ->latest('published_at')
            ->paginate(15);

        return view('public.blog.index', compact('posts', 'categories', 'categorySlug'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::where('slug', $slug)->published()->with('category')->firstOrFail();

        return view('public.blog.show', compact('post'));
    }
}
