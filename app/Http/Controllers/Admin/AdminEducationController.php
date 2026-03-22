<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class AdminEducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderByDesc('start_year')->paginate(15);
        return view('admin.educations.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.educations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'start_year' => 'required|integer|min:1900|max:2100',
            'end_year' => 'nullable|integer|min:1900|max:2100',
            'description' => 'nullable|string',
        ]);

        Education::create($validated);

        return redirect()->route('admin.educations.index')->with('success', 'Formation créée.');
    }

    public function edit(Education $education)
    {
        return view('admin.educations.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'start_year' => 'required|integer|min:1900|max:2100',
            'end_year' => 'nullable|integer|min:1900|max:2100',
            'description' => 'nullable|string',
        ]);

        $education->update($validated);

        return redirect()->route('admin.educations.index')->with('success', 'Formation mise à jour.');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('admin.educations.index')->with('success', 'Formation supprimée.');
    }
}
