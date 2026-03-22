<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;

class ProjectController extends Controller
{
    public function index()
    {
        $categories = ProjectCategory::all();
        $categorySlug = request('category');

        $projects = Project::with('category')
            ->when($categorySlug, fn ($q) => $q->whereHas('category', fn ($q2) => $q2->where('slug', $categorySlug)))
            ->orderBy('order')
            ->paginate(15);

        return view('public.projects.index', compact('projects', 'categories', 'categorySlug'));
    }

    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->with('category')->firstOrFail();

        return view('public.projects.show', compact('project'));
    }
}
