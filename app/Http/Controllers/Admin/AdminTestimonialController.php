<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_role' => 'nullable|string|max:255',
            'client_photo' => 'nullable|image|max:2048',
            'content' => 'required|string|max:2000',
            'rating' => 'required|integer|min:1|max:5',
            'is_published' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('client_photo')) {
            $validated['client_photo'] = $request->file('client_photo')->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage créé.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_role' => 'nullable|string|max:255',
            'client_photo' => 'nullable|image|max:2048',
            'content' => 'required|string|max:2000',
            'rating' => 'required|integer|min:1|max:5',
            'is_published' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('client_photo')) {
            if ($testimonial->client_photo && Storage::disk('public')->exists($testimonial->client_photo)) {
                Storage::disk('public')->delete($testimonial->client_photo);
            }
            $validated['client_photo'] = $request->file('client_photo')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage mis à jour.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->client_photo && Storage::disk('public')->exists($testimonial->client_photo)) {
            Storage::disk('public')->delete($testimonial->client_photo);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Témoignage supprimé.');
    }
}
