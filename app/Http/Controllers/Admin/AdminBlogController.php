<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category')
            ->when(request('search'), fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->latest()
            ->paginate(15);

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'is_published' => 'boolean',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');

        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('blog', 'public');
        }

        BlogPost::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Article créé avec succès.');
    }

    public function edit(BlogPost $blog)
    {
        $categories = BlogCategory::all();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'is_published' => 'boolean',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');

        if ($validated['is_published'] && !$blog->published_at) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('cover_image')) {
            if ($blog->cover_image && Storage::disk('public')->exists($blog->cover_image)) {
                Storage::disk('public')->delete($blog->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('blog', 'public');
        }

        $blog->update($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Article mis à jour.');
    }

    public function destroy(BlogPost $blog)
    {
        if ($blog->cover_image && Storage::disk('public')->exists($blog->cover_image)) {
            Storage::disk('public')->delete($blog->cover_image);
        }
        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Article supprimé.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,gif,webp|max:4096',
        ]);

        $path = $request->file('image')->store('blog/content', 'public');

        return response()->json([
            'location' => Storage::url($path),
        ]);
    }
}
