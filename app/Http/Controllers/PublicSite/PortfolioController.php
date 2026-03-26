<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('public.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('public.portfolios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $file = $request->file('file');
        $path = $file->store('portfolios', 'public');

        $portfolio = Portfolio::create([
            'title' => $request->input('title'),
            'filename' => basename($path),
            'mime' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);

        return redirect()->route('portfolios.index')->with('success', 'Portfolio uploaded.');
    }

    public function download(Portfolio $portfolio)
    {
        $path = 'portfolios/' . $portfolio->filename;
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
        return Storage::disk('public')->download($path, $portfolio->title . '.' . pathinfo($portfolio->filename, PATHINFO_EXTENSION));
    }

    public function downloadCV()
    {
        $cv = Portfolio::where('is_cv', true)->latest()->first();
        if (!$cv) {
            abort(404);
        }
        $path = 'portfolios/' . $cv->filename;
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
        return Storage::disk('public')->download($path, $cv->title . '.' . pathinfo($cv->filename, PATHINFO_EXTENSION));
    }
}
