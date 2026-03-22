<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AdminSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            if ($request->hasFile($key)) {
                $old = Setting::where('key', $key)->value('value');
                if ($old && Storage::disk('public')->exists($old)) {
                    Storage::disk('public')->delete($old);
                }
                $value = $request->file($key)->store('settings', 'public');
            }

            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Cache::flush();

        return back()->with('success', 'Paramètres enregistrés avec succès.');
    }
}
