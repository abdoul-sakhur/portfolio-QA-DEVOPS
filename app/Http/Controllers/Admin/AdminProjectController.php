<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')
            ->when(request('search'), fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->orderBy('order')
            ->paginate(15);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = ProjectCategory::all();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'category_id' => 'required|exists:project_categories,id',
            'is_featured' => 'boolean',
            'order' => 'integer',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Projet créé avec succès.');
    }

    public function edit(Project $project)
    {
        $categories = ProjectCategory::all();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'category_id' => 'required|exists:project_categories,id',
            'is_featured' => 'boolean',
            'order' => 'integer',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('cover_image')) {
            if ($project->cover_image && Storage::disk('public')->exists($project->cover_image)) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Projet mis à jour.');
    }

    public function destroy(Project $project)
    {
        if ($project->cover_image && Storage::disk('public')->exists($project->cover_image)) {
            Storage::disk('public')->delete($project->cover_image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Projet supprimé.');
    }
}
