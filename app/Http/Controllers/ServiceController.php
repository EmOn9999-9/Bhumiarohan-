<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services.index', ['services' => Service::active()->get()]);
    }

    public function show(Service $service)
    {
        abort_unless($service->is_active, 404);

        return view('services.show', [
            'service' => $service,
            'projects' => $service->projects()->published()->latest()->take(3)->get(),
            'others' => Service::active()->whereKeyNot($service->id)->get(),
        ]);
    }
}
