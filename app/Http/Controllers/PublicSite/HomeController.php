<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Certification;
use App\Models\Experience;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;

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
        $testimonials = Testimonial::published()->orderBy('order')->take(6)->get();

        // Key figures
        $firstExp = Experience::orderBy('start_date')->first();
        $yearsExperience = $firstExp ? (int) $firstExp->start_date->diffInYears(now()) : 0;
        $stats = [
            ['value' => $yearsExperience, 'suffix' => '+', 'label' => 'Années d\'expérience'],
            ['value' => Project::count(), 'suffix' => '+', 'label' => 'Projets réalisés'],
            ['value' => Certification::count(), 'suffix' => '', 'label' => 'Certifications'],
            ['value' => Skill::count(), 'suffix' => '+', 'label' => 'Compétences'],
        ];

        return view('public.home', compact('skills', 'featuredProjects', 'latestPosts', 'cv', 'testimonials', 'stats'));
    }
}
