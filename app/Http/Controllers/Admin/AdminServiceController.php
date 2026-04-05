<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->paginate(15);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|image|max:2048',
            'short_description' => 'required|string|max:500',
            'description' => 'nullable|string|max:5000',
            'price_label' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service créé.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|image|max:2048',
            'short_description' => 'required|string|max:500',
            'description' => 'nullable|string|max:5000',
            'price_label' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'order' => 'integer',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('icon')) {
            if ($service->icon && Storage::disk('public')->exists($service->icon)) {
                Storage::disk('public')->delete($service->icon);
            }
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service mis à jour.');
    }

    public function destroy(Service $service)
    {
        if ($service->icon && Storage::disk('public')->exists($service->icon)) {
            Storage::disk('public')->delete($service->icon);
        }
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service supprimé.');
    }
}
