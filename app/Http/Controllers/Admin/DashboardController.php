<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Certification;
use App\Models\ContactMessage;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'posts' => BlogPost::count(),
            'certifications' => Certification::count(),
            'messages' => ContactMessage::where('is_read', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
