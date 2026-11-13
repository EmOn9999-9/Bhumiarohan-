@props(['project'])
<a href="{{ route('projects.show', $project) }}" class="card card-hover group block overflow-hidden reveal" data-category="{{ $project->service_id ?? 'other' }}">
    <div class="relative aspect-[4/3] overflow-hidden">
        <x-media :src="$project->cover_image" :alt="$project->title" class="size-full transition duration-500 group-hover:scale-105" />
        <span class="absolute left-3 top-3 rounded-full bg-white/95 px-2.5 py-1 text-xs font-semibold text-slate-800 shadow-sm">{{ $project->status_label }}</span>
    </div>
    <div class="p-5">
        @if ($project->service)<p class="text-xs font-semibold uppercase tracking-wider text-brand-600">{{ $project->service->title }}</p>@endif
        <h3 class="mt-1.5 text-lg font-bold group-hover:text-brand-700">{{ $project->title }}</h3>
        @if ($project->location)
            <p class="mt-2 flex items-center gap-1.5 text-sm text-slate-500"><x-icon name="pin" class="size-4" /> {{ $project->location }}</p>
        @endif
    </div>
</a>
