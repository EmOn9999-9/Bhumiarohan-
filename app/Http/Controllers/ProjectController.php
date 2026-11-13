<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::published()->with('service')->orderByDesc('is_featured')->latest()->get();

        return view('projects.index', [
            'projects' => $projects,
            'categories' => Service::whereIn('id', $projects->pluck('service_id')->filter()->unique())
                ->orderBy('sort_order')->get(),
        ]);
    }

    public function show(Project $project)
    {
        abort_unless($project->is_published, 404);

        return view('projects.show', [
            'project' => $project->load('images', 'service'),
            'related' => Project::published()->whereKeyNot($project->id)
                ->where('service_id', $project->service_id)->latest()->take(3)->get(),
        ]);
    }
}
