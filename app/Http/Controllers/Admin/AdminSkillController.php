<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('order')->paginate(15);
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|max:2048',
            'level' => 'required|integer|min:0|max:100',
            'category' => 'required|string|max:255',
            'order' => 'integer',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('skills', 'public');
        }

        Skill::create($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Compétence créée.');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|image|max:2048',
            'level' => 'required|integer|min:0|max:100',
            'category' => 'required|string|max:255',
            'order' => 'integer',
        ]);

        if ($request->hasFile('icon')) {
            if ($skill->icon && Storage::disk('public')->exists($skill->icon)) {
                Storage::disk('public')->delete($skill->icon);
            }
            $validated['icon'] = $request->file('icon')->store('skills', 'public');
        }

        $skill->update($validated);

        return redirect()->route('admin.skills.index')->with('success', 'Compétence mise à jour.');
    }

    public function destroy(Skill $skill)
    {
        if ($skill->icon && Storage::disk('public')->exists($skill->icon)) {
            Storage::disk('public')->delete($skill->icon);
        }
        $skill->delete();
        return redirect()->route('admin.skills.index')->with('success', 'Compétence supprimée.');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:skills,id',
        ]);

        foreach ($validated['ids'] as $index => $id) {
            Skill::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
