<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Skill;

class HomeController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('order')->get();
        $featuredProjects = Project::where('is_featured', true)
            ->orderBy('order')
            ->with('category')
            ->take(6)
            ->get();
        $latestPosts = BlogPost::published()
            ->with('category')
            ->latest('published_at')
            ->take(3)
            ->get();
        $cv = Portfolio::where('is_cv', true)->latest()->first();

        return view('public.home', compact('skills', 'featuredProjects', 'latestPosts', 'cv'));
    }
}
