<x-layouts.admin title="Inquiry">
    <x-slot:actions><a href="{{ route('admin.inquiries.index') }}" class="btn btn-outline btn-sm"><x-icon name="arrow-left" class="size-4" /> Back</a></x-slot:actions>
    <div class="card max-w-3xl p-6 sm:p-8">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold">{{ $inquiry->name }}</h2>
                <p class="text-sm text-slate-500">{{ $inquiry->created_at->format('l, M j, Y \a\t g:i A') }}</p>
            </div>
            @if ($inquiry->service)<span class="rounded-full bg-brand-50 px-3 py-1 text-xs font-semibold text-brand-700">{{ $inquiry->service }}</span>@endif
        </div>
        <dl class="mt-6 grid gap-4 border-y border-slate-100 py-5 text-sm sm:grid-cols-2">
            <div><dt class="text-slate-500">Phone</dt><dd><a href="tel:{{ $inquiry->phone }}" class="font-medium text-brand-700 hover:underline">{{ $inquiry->phone }}</a></dd></div>
            <div><dt class="text-slate-500">Email</dt><dd>@if ($inquiry->email)<a href="mailto:{{ $inquiry->email }}" class="font-medium text-brand-700 hover:underline">{{ $inquiry->email }}</a>@else — @endif</dd></div>
        </dl>
        <p class="mt-5 whitespace-pre-line leading-relaxed text-slate-700">{{ $inquiry->message }}</p>
        <div class="mt-8 flex flex-wrap gap-2">
            <form method="POST" action="{{ route('admin.inquiries.toggle', $inquiry) }}">@csrf @method('PATCH')<button class="btn btn-outline btn-sm">Mark as unread</button></form>
            <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" data-confirm="Delete this inquiry?">@csrf @method('DELETE')<button class="btn btn-danger btn-sm"><x-icon name="trash" class="size-4" /> Delete</button></form>
        </div>
    </div>
</x-layouts.admin>
