<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public const ICONS = ['building', 'cube', 'brush', 'wrench', 'home', 'truck', 'beaker', 'map', 'shield', 'calculator'];

    public function index()
    {
        return view('admin.services.index', ['services' => Service::withCount('projects')->orderBy('sort_order')->get()]);
    }

    public function create()
    {
        return view('admin.services.form', ['service' => new Service(['is_active' => true, 'icon' => 'building']), 'icons' => self::ICONS]);
    }

    public function store(Request $request)
    {
        Service::create($this->validated($request));

        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', ['service' => $service, 'icons' => self::ICONS]);
    }

    public function update(Request $request, Service $service)
    {
        $service->update($this->validated($request, $service));

        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $this->deleteImage($service->image);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }

    private function validated(Request $request, ?Service $service = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'icon' => ['required', Rule::in(self::ICONS)],
            'short_description' => ['required', 'string', 'max:300'],
            'description' => ['nullable', 'string'],
            'features' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:5120'],
        ]);

        $slug = Str::slug($data['title']);
        $exists = Service::where('slug', $slug)->when($service, fn ($q) => $q->whereKeyNot($service->id))->exists();
        $data['slug'] = $exists ? $slug.'-'.Str::lower(Str::random(4)) : $slug;
        $data['features'] = collect(preg_split('/\r?\n/', $data['features'] ?? ''))->map('trim')->filter()->values()->all();
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');
        $data['image'] = $this->storeImage($request, 'image', 'services', $service?->image);

        return $data;
    }
}
