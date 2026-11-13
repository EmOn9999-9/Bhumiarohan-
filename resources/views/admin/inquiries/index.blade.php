<x-layouts.admin title="Inquiries">
    <div class="card overflow-hidden">
        @forelse ($inquiries as $inq)
            <a href="{{ route('admin.inquiries.show', $inq) }}" class="flex items-start gap-4 border-b border-slate-100 px-5 py-4 last:border-0 hover:bg-slate-50">
                <span class="mt-1.5 size-2 shrink-0 rounded-full {{ $inq->is_read ? 'bg-slate-200' : 'bg-accent-500' }}" title="{{ $inq->is_read ? 'Read' : 'Unread' }}"></span>
                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-baseline justify-between gap-x-4">
                        <p class="text-sm {{ $inq->is_read ? 'text-slate-700' : 'font-bold text-slate-900' }}">{{ $inq->name }} <span class="font-normal text-slate-400">· {{ $inq->phone }}</span></p>
                        <p class="text-xs text-slate-400">{{ $inq->created_at->format('M j, Y g:i A') }}</p>
                    </div>
                    @if ($inq->service)<p class="mt-0.5 text-xs font-medium text-brand-700">{{ $inq->service }}</p>@endif
                    <p class="mt-1 truncate text-sm text-slate-500">{{ $inq->message }}</p>
                </div>
            </a>
        @empty
            <p class="px-6 py-16 text-center text-slate-500">No inquiries yet. Messages from the contact form will appear here.</p>
        @endforelse
        @if ($inquiries->hasPages())<div class="border-t border-slate-200 px-5 py-3">{{ $inquiries->links() }}</div>@endif
    </div>
</x-layouts.admin>
