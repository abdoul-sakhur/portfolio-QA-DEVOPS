<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\CertificationCategory;

class CertificationController extends Controller
{
    public function index()
    {
        $categories = CertificationCategory::all();
        $categorySlug = request('category');

        $certifications = Certification::with('category')
            ->when($categorySlug, fn ($q) => $q->whereHas('category', fn ($q2) => $q2->where('slug', $categorySlug)))
            ->latest('issue_date')
            ->paginate(15);

        return view('public.certifications.index', compact('certifications', 'categories', 'categorySlug'));
    }
}
