<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class AdminExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('order')->paginate(15);
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'order' => 'integer',
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        Experience::create($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Expérience créée.');
    }

    public function edit(Experience $experience)
    {
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'order' => 'integer',
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        $experience->update($validated);

        return redirect()->route('admin.experiences.index')->with('success', 'Expérience mise à jour.');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Expérience supprimée.');
    }
}
