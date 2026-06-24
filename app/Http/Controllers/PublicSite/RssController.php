<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class RssController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()
            ->with('category')
            ->latest('published_at')
            ->take(20)
            ->get();

        return response()
            ->view('public.rss', compact('posts'))
            ->header('Content-Type', 'application/rss+xml; charset=utf-8');
    }
}
