<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', [
            'projects' => Project::with('service')->withCount('images')->latest()->paginate(15),
        ]);
    }

    public function create()
    {
        return view('admin.projects.form', ['project' => new Project(['status' => 'completed', 'is_published' => true]), 'services' => Service::orderBy('sort_order')->get()]);
    }

    public function store(Request $request)
    {
        $project = Project::create($this->validated($request));
        $this->saveImages($request, $project);

        return redirect()->route('admin.projects.edit', $project)->with('success', 'Project created.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', ['project' => $project->load('images'), 'services' => Service::orderBy('sort_order')->get()]);
    }

    public function update(Request $request, Project $project)
    {
        $project->update($this->validated($request, $project));
        $this->saveImages($request, $project);

        return redirect()->route('admin.projects.edit', $project)->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        $this->deleteImage($project->cover_image);
        $project->images->each(fn ($img) => $this->deleteImage($img->path));
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted.');
    }

    public function destroyImage(ProjectImage $image)
    {
        $this->deleteImage($image->path);
        $image->delete();

        return back()->with('success', 'Image removed.');
    }

    private function validated(Request $request, ?Project $project = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'service_id' => ['nullable', 'exists:services,id'],
            'location' => ['nullable', 'string', 'max:200'],
            'client' => ['nullable', 'string', 'max:200'],
            'status' => ['required', Rule::in(array_keys(Project::STATUSES))],
            'year' => ['nullable', 'string', 'max:10'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
            'gallery.*' => ['nullable', 'image', 'max:5120'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');
        $data['slug'] = $this->uniqueSlug($data['title'], $project?->id);
        $data['cover_image'] = $this->storeImage($request, 'cover_image', 'projects', $project?->cover_image);
        unset($data['gallery']);

        return $data;
    }

    private function saveImages(Request $request, Project $project): void
    {
        $next = (int) $project->images()->max('sort_order');
        foreach ($request->file('gallery', []) as $file) {
            $project->images()->create(['path' => $file->store('projects/gallery', 'public'), 'sort_order' => ++$next]);
        }
    }

    private function uniqueSlug(string $title, ?int $ignoreId): string
    {
        $base = Str::slug($title) ?: 'project';
        $slug = $base;
        $i = 2;
        while (Project::where('slug', $slug)->when($ignoreId, fn ($q) => $q->whereKeyNot($ignoreId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
