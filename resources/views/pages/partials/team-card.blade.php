<div class="card overflow-hidden reveal">
    @if ($member->photo)
        <x-media :src="$member->photo" :alt="$member->name" class="aspect-[4/5] w-full" />
    @else
        <div class="grid aspect-[4/5] place-items-center bg-gradient-to-br from-brand-50 to-brand-100">
            <span class="font-display text-5xl font-extrabold text-brand-700/70">{{ $member->initials }}</span>
        </div>
    @endif
    <div class="p-5">
        <h3 class="text-lg font-bold">{{ $member->name }}</h3>
        <p class="text-sm font-medium text-brand-700">{{ $member->role }}</p>
        @if ($member->qualification)<p class="mt-1 text-sm text-slate-500">{{ $member->qualification }}</p>@endif
        @if (! empty($full) && $member->bio)<p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $member->bio }}</p>@endif
        @if (! empty($full) && ($member->email || $member->phone))
            <div class="mt-4 flex flex-wrap gap-3 text-sm">
                @if ($member->email)<a href="mailto:{{ $member->email }}" class="inline-flex items-center gap-1.5 text-slate-600 hover:text-brand-700"><x-icon name="mail" class="size-4" /> Email</a>@endif
                @if ($member->phone)<a href="tel:{{ $member->phone }}" class="inline-flex items-center gap-1.5 text-slate-600 hover:text-brand-700"><x-icon name="phone" class="size-4" /> Call</a>@endif
            </div>
        @endif
    </div>
</div>
