<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $projects = Project::select('slug', 'updated_at')->get();
        $posts = BlogPost::published()->select('slug', 'updated_at')->get();

        $content = view('public.sitemap', compact('projects', 'posts'))->render();

        return response($content, 200)->header('Content-Type', 'application/xml');
    }
}
