<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\CertificationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::with('category')
            ->when(request('search'), fn ($q, $s) => $q->where('title', 'like', "%{$s}%"))
            ->latest('issue_date')
            ->paginate(15);

        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        $categories = CertificationCategory::all();
        return view('admin.certifications.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'credential_url' => 'nullable|url|max:255',
            'category_id' => 'required|exists:certification_categories,id',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('certifications', 'public');
        }

        Certification::create($validated);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification créée.');
    }

    public function edit(Certification $certification)
    {
        $categories = CertificationCategory::all();
        return view('admin.certifications.edit', compact('certification', 'categories'));
    }

    public function update(Request $request, Certification $certification)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'credential_url' => 'nullable|url|max:255',
            'category_id' => 'required|exists:certification_categories,id',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($certification->cover_image && Storage::disk('public')->exists($certification->cover_image)) {
                Storage::disk('public')->delete($certification->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('certifications', 'public');
        }

        $certification->update($validated);

        return redirect()->route('admin.certifications.index')->with('success', 'Certification mise à jour.');
    }

    public function destroy(Certification $certification)
    {
        if ($certification->cover_image && Storage::disk('public')->exists($certification->cover_image)) {
            Storage::disk('public')->delete($certification->cover_image);
        }
        $certification->delete();

        return redirect()->route('admin.certifications.index')->with('success', 'Certification supprimée.');
    }
}
