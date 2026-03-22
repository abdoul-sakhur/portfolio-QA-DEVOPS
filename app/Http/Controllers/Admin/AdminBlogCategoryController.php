<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('posts')->paginate(15);
        return view('admin.blog.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $validated['slug'] = Str::slug($validated['name']);

        BlogCategory::create($validated);

        return back()->with('success', 'Catégorie créée.');
    }

    public function update(Request $request, BlogCategory $category)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return back()->with('success', 'Catégorie mise à jour.');
    }

    public function destroy(BlogCategory $category)
    {
        $category->delete();
        return back()->with('success', 'Catégorie supprimée.');
    }
}
