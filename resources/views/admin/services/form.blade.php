<x-layouts.admin :title="$service->exists ? 'Edit service' : 'New service'">
    <form method="POST" enctype="multipart/form-data" action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" class="grid gap-6 xl:grid-cols-3">
        @csrf
        @if ($service->exists) @method('PUT') @endif
        <div class="card space-y-5 p-6 xl:col-span-2">
            <x-admin.field name="title" label="Title" :value="$service->title" required />
            <x-admin.field name="short_description" label="Short description" type="textarea" rows="2" :value="$service->short_description" hint="One or two sentences, shown on service cards." required />
            <x-admin.field name="description" label="Full description" type="textarea" rows="8" :value="$service->description" hint="Leave a blank line between paragraphs." />
            <x-admin.field name="features" label="Features (one per line)" type="textarea" rows="6" :value="implode(PHP_EOL, $service->features ?? [])" />
        </div>
        <div class="space-y-6">
            <div class="card space-y-4 p-6">
                <x-admin.toggle name="is_active" label="Visible on website" :checked="$service->is_active" />
                <x-admin.field name="sort_order" label="Display order" type="number" :value="$service->sort_order" />
                <button class="btn btn-primary w-full">{{ $service->exists ? 'Save changes' : 'Create service' }}</button>
            </div>
            <div class="card p-6">
                <span class="form-label">Icon</span>
                <div class="grid grid-cols-5 gap-2">
                    @foreach ($icons as $icon)
                        <label class="cursor-pointer">
                            <input type="radio" name="icon" value="{{ $icon }}" class="peer sr-only" @checked(old('icon', $service->icon) === $icon)>
                            <span class="grid aspect-square place-items-center rounded-lg border border-slate-200 text-slate-500 peer-checked:border-brand-600 peer-checked:bg-brand-50 peer-checked:text-brand-700 peer-focus-visible:ring-2 peer-focus-visible:ring-brand-400" title="{{ $icon }}"><x-icon :name="$icon" class="size-5" /></span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="card p-6"><x-admin.image-field name="image" label="Banner image (optional)" :current="$service->image" /></div>
        </div>
    </form>
    @if ($service->exists)
        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" data-confirm="Delete this service? Linked projects will lose their category." class="mt-6">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm"><x-icon name="trash" class="size-4" /> Delete service</button>
        </form>
    @endif
</x-layouts.admin>
