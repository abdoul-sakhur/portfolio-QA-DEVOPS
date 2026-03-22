<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CertificationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCertificationCategoryController extends Controller
{
    public function index()
    {
        $categories = CertificationCategory::withCount('certifications')->paginate(15);
        return view('admin.certifications.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $validated['slug'] = Str::slug($validated['name']);

        CertificationCategory::create($validated);

        return back()->with('success', 'Catégorie créée.');
    }

    public function update(Request $request, CertificationCategory $category)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return back()->with('success', 'Catégorie mise à jour.');
    }

    public function destroy(CertificationCategory $category)
    {
        $category->delete();
        return back()->with('success', 'Catégorie supprimée.');
    }
}
