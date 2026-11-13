<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'counts' => [
                'projects' => Project::count(),
                'services' => Service::count(),
                'team' => TeamMember::count(),
                'unread' => Inquiry::where('is_read', false)->count(),
            ],
            'inquiries' => Inquiry::latest()->take(5)->get(),
        ]);
    }
}
