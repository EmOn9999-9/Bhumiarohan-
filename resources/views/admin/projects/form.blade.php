<x-layouts.admin :title="$project->exists ? 'Edit project' : 'New project'">
    @if ($project->exists)
        <x-slot:actions><a href="{{ route('projects.show', $project) }}" target="_blank" class="btn btn-outline btn-sm"><x-icon name="external" class="size-4" /> View</a></x-slot:actions>
    @endif

    <form method="POST" enctype="multipart/form-data" action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" class="grid gap-6 xl:grid-cols-3">
        @csrf
        @if ($project->exists) @method('PUT') @endif

        <div class="card space-y-5 p-6 xl:col-span-2">
            <x-admin.field name="title" label="Project title" :value="$project->title" required />
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="service_id" class="form-label">Service / category</label>
                    <select id="service_id" name="service_id" class="form-input">
                        <option value="">None</option>
                        @foreach ($services as $s)
                            <option value="{{ $s->id }}" @selected(old('service_id', $project->service_id) == $s->id)>{{ $s->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="status" class="form-label">Status <span class="text-red-500">*</span></label>
                    <select id="status" name="status" class="form-input">
                        @foreach (\App\Models\Project::STATUSES as $k => $v)
                            <option value="{{ $k }}" @selected(old('status', $project->status) === $k)>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>
                <x-admin.field name="location" label="Location" :value="$project->location" />
                <x-admin.field name="client" label="Client" :value="$project->client" />
                <x-admin.field name="year" label="Year" :value="$project->year" hint="e.g. 2082 B.S. or 2025" />
            </div>
            <x-admin.field name="description" label="Description" type="textarea" rows="8" :value="$project->description" hint="Leave a blank line between paragraphs." />
        </div>

        <div class="space-y-6">
            <div class="card space-y-4 p-6">
                <x-admin.toggle name="is_published" label="Visible on website" :checked="$project->is_published" />
                <x-admin.toggle name="is_featured" label="Featured (shown first)" :checked="$project->is_featured" />
                <button class="btn btn-primary w-full">{{ $project->exists ? 'Save changes' : 'Create project' }}</button>
            </div>
            <div class="card space-y-6 p-6">
                <x-admin.image-field name="cover_image" label="Cover image" :current="$project->cover_image" />
                <x-admin.image-field name="gallery" label="Add gallery photos" multiple />
            </div>
        </div>
    </form>

    @if ($project->exists && $project->images->isNotEmpty())
        <div class="card mt-6 p-6">
            <h2 class="font-bold">Gallery ({{ $project->images->count() }})</h2>
            <div class="mt-4 grid grid-cols-3 gap-3 sm:grid-cols-5 lg:grid-cols-8">
                @foreach ($project->images as $img)
                    <div class="group relative">
                        <img src="{{ asset('storage/'.$img->path) }}" alt="" class="aspect-square w-full rounded-lg object-cover">
                        <form method="POST" action="{{ route('admin.project-images.destroy', $img) }}" data-confirm="Remove this photo?" class="absolute right-1 top-1">
                            @csrf @method('DELETE')
                            <button class="grid size-7 place-items-center rounded-full bg-white/90 text-red-600 shadow hover:bg-white" aria-label="Remove photo"><x-icon name="trash" class="size-4" /></button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if ($project->exists)
        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" data-confirm="Delete this project and all its photos? This cannot be undone." class="mt-6">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm"><x-icon name="trash" class="size-4" /> Delete project</button>
        </form>
    @endif
</x-layouts.admin>
