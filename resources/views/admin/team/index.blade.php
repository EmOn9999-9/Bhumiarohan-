<x-layouts.admin title="Team">
    <x-slot:actions><a href="{{ route('admin.team.create') }}" class="btn btn-primary btn-sm"><x-icon name="plus" class="size-4" /> Add member</a></x-slot:actions>
    @if ($members->isEmpty())
        <div class="card px-6 py-16 text-center">
            <p class="text-slate-500">No team members yet. The Team page shows a "coming soon" message until you add some.</p>
            <a href="{{ route('admin.team.create') }}" class="btn btn-primary mt-4">Add team member</a>
        </div>
    @else
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            @foreach ($members as $m)
                <a href="{{ route('admin.team.edit', $m) }}" class="card card-hover flex items-center gap-4 p-4">
                    @if ($m->photo)
                        <img src="{{ asset('storage/'.$m->photo) }}" alt="" class="size-14 rounded-full object-cover">
                    @else
                        <span class="grid size-14 place-items-center rounded-full bg-brand-50 font-bold text-brand-700">{{ $m->initials }}</span>
                    @endif
                    <div class="min-w-0">
                        <p class="truncate font-semibold text-slate-900">{{ $m->name }}</p>
                        <p class="truncate text-sm text-slate-500">{{ $m->role }}</p>
                        @unless ($m->is_active)<p class="text-xs text-slate-400">Hidden</p>@endunless
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</x-layouts.admin>
