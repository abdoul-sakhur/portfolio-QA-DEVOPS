<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;

class AboutController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('order')->get();
        $educations = Education::orderByDesc('start_year')->get();

        return view('public.about', compact('experiences', 'educations'));
    }
}
