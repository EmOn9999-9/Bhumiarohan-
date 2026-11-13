<x-layouts.admin title="Dashboard">
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['Projects', $counts['projects'], 'building', route('admin.projects.index')],
            ['Services', $counts['services'], 'briefcase', route('admin.services.index')],
            ['Team members', $counts['team'], 'users', route('admin.team.index')],
            ['Unread inquiries', $counts['unread'], 'inbox', route('admin.inquiries.index')],
        ] as [$label, $count, $icon, $url])
            <a href="{{ $url }}" class="card card-hover flex items-center gap-4 p-5">
                <span class="grid size-12 place-items-center rounded-xl bg-brand-50 text-brand-700"><x-icon :name="$icon" /></span>
                <div>
                    <p class="font-display text-2xl font-extrabold text-slate-900">{{ $count }}</p>
                    <p class="text-sm text-slate-500">{{ $label }}</p>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-3">
        <div class="card xl:col-span-2">
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                <h2 class="font-bold">Latest inquiries</h2>
                <a href="{{ route('admin.inquiries.index') }}" class="text-sm font-medium text-brand-700 hover:underline">View all</a>
            </div>
            @forelse ($inquiries as $inq)
                <a href="{{ route('admin.inquiries.show', $inq) }}" class="flex items-start gap-4 border-b border-slate-100 px-6 py-4 last:border-0 hover:bg-slate-50">
                    <span class="mt-1.5 size-2 shrink-0 rounded-full {{ $inq->is_read ? 'bg-slate-200' : 'bg-accent-500' }}"></span>
                    <div class="min-w-0 flex-1">
                        <p class="flex justify-between gap-2 text-sm"><span class="font-semibold text-slate-900">{{ $inq->name }}</span><span class="shrink-0 text-xs text-slate-400">{{ $inq->created_at->diffForHumans() }}</span></p>
                        <p class="truncate text-sm text-slate-500">{{ $inq->service ? $inq->service.': ' : '' }}{{ $inq->message }}</p>
                    </div>
                </a>
            @empty
                <p class="px-6 py-10 text-center text-sm text-slate-500">No inquiries yet.</p>
            @endforelse
        </div>
        <div class="card p-6">
            <h2 class="font-bold">Quick actions</h2>
            <div class="mt-4 grid gap-2">
                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary justify-start"><x-icon name="plus" class="size-4" /> Add project</a>
                <a href="{{ route('admin.team.create') }}" class="btn btn-outline justify-start"><x-icon name="plus" class="size-4" /> Add team member</a>
                <a href="{{ route('admin.services.create') }}" class="btn btn-outline justify-start"><x-icon name="plus" class="size-4" /> Add service</a>
            </div>
            <p class="mt-6 text-xs leading-relaxed text-slate-500">Company contact details (phone, email, address, social links, registration status) are set in the <code class="rounded bg-slate-100 px-1">.env</code> file or <code class="rounded bg-slate-100 px-1">config/company.php</code>.</p>
        </div>
    </div>
</x-layouts.admin>
