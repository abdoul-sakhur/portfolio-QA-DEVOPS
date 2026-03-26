<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminCVController extends Controller
{
    public function index()
    {
        $cv = Portfolio::where('is_cv', true)->latest()->first();
        return view('admin.cv.index', compact('cv'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $file = $request->file('file');
        $path = $file->store('portfolios', 'public');

        // Unset previous CV flags
        Portfolio::where('is_cv', true)->update(['is_cv' => false]);

        $portfolio = Portfolio::create([
            'title' => $request->input('title'),
            'filename' => basename($path),
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'is_cv' => true,
        ]);

        return redirect()->route('admin.cv.index')->with('success', 'CV uploaded.');
    }

    public function download(Portfolio $portfolio)
    {
        $path = 'portfolios/' . $portfolio->filename;
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
        return Storage::disk('public')->download($path, $portfolio->title . '.' . pathinfo($portfolio->filename, PATHINFO_EXTENSION));
    }

    public function destroy(Portfolio $portfolio)
    {
        // Delete file
        $path = 'portfolios/' . $portfolio->filename;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        // If this was the CV, just delete the record
        $portfolio->delete();

        return redirect()->route('admin.cv.index')->with('success', 'CV supprimé.');
    }
}
