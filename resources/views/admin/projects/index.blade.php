<x-layouts.admin title="Projects">
    <x-slot:actions><a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm"><x-icon name="plus" class="size-4" /> Add project</a></x-slot:actions>

    <div class="card overflow-hidden">
        @if ($projects->isEmpty())
            <div class="px-6 py-16 text-center">
                <p class="text-slate-500">No projects yet.</p>
                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary mt-4">Add your first project</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                        <tr><th class="px-5 py-3">Project</th><th class="px-5 py-3">Service</th><th class="px-5 py-3">Status</th><th class="px-5 py-3">Visible</th><th class="px-5 py-3"></th></tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($projects as $p)
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-3">
                                    <div class="flex items-center gap-3">
                                        <x-media :src="$p->cover_image" alt="" class="size-12 shrink-0 rounded-lg [&_svg]:size-5" />
                                        <div>
                                            <p class="font-semibold text-slate-900">{{ $p->title }} @if ($p->is_featured)<span class="ml-1 rounded bg-accent-500/20 px-1.5 py-0.5 text-[10px] font-semibold text-accent-600">FEATURED</span>@endif</p>
                                            <p class="text-xs text-slate-500">{{ $p->location }} · {{ $p->images_count }} photos</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3 text-slate-600">{{ $p->service?->title ?? '—' }}</td>
                                <td class="px-5 py-3 text-slate-600">{{ $p->status_label }}</td>
                                <td class="px-5 py-3">{!! $p->is_published ? '<span class="text-emerald-600">Yes</span>' : '<span class="text-slate-400">Hidden</span>' !!}</td>
                                <td class="px-5 py-3 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.projects.edit', $p) }}" class="btn btn-outline btn-sm"><x-icon name="pencil" class="size-3.5" /> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="border-t border-slate-200 px-5 py-3">{{ $projects->links() }}</div>
        @endif
    </div>
</x-layouts.admin>
