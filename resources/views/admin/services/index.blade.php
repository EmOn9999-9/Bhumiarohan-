<x-layouts.admin title="Services">
    <x-slot:actions><a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm"><x-icon name="plus" class="size-4" /> Add service</a></x-slot:actions>
    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-200 bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr><th class="px-5 py-3">#</th><th class="px-5 py-3">Service</th><th class="px-5 py-3">Projects</th><th class="px-5 py-3">Visible</th><th class="px-5 py-3"></th></tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($services as $s)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 text-slate-400">{{ $s->sort_order }}</td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-3">
                                    <span class="grid size-9 place-items-center rounded-lg bg-brand-50 text-brand-700"><x-icon :name="$s->icon" class="size-5" /></span>
                                    <span class="font-semibold text-slate-900">{{ $s->title }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3 text-slate-600">{{ $s->projects_count }}</td>
                            <td class="px-5 py-3">{!! $s->is_active ? '<span class="text-emerald-600">Yes</span>' : '<span class="text-slate-400">Hidden</span>' !!}</td>
                            <td class="px-5 py-3 text-right"><a href="{{ route('admin.services.edit', $s) }}" class="btn btn-outline btn-sm"><x-icon name="pencil" class="size-3.5" /> Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.admin>
