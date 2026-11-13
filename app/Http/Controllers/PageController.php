<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'services' => Service::active()->get(),
            'projects' => Project::published()->with('service')
                ->orderByDesc('is_featured')->latest()->take(6)->get(),
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'team' => TeamMember::active()->take(4)->get(),
        ]);
    }

    public function team()
    {
        return view('pages.team', ['team' => TeamMember::active()->get()]);
    }

    public function converter()
    {
        return view('pages.converter');
    }
}
