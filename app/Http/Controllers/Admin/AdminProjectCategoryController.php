<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProjectCategoryController extends Controller
{
    public function index()
    {
        $categories = ProjectCategory::withCount('projects')->paginate(15);
        return view('admin.projects.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);
        $validated['slug'] = Str::slug($validated['name']);

        ProjectCategory::create($validated);

        return back()->with('success', 'Catégorie créée.');
    }

    public function update(Request $request, ProjectCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);
        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return back()->with('success', 'Catégorie mise à jour.');
    }

    public function destroy(ProjectCategory $category)
    {
        $category->delete();
        return back()->with('success', 'Catégorie supprimée.');
    }
}
