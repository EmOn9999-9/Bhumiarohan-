@props(['title', 'eyebrow' => null, 'crumbs' => [], 'aside' => null])
<section class="relative overflow-hidden bg-brand-950 pt-32 pb-16 sm:pt-40 sm:pb-20">
    <div class="pattern-grid absolute inset-0" aria-hidden="true"></div>
    <div class="absolute -right-24 -top-24 size-96 rounded-full bg-brand-600/20 blur-3xl" aria-hidden="true"></div>
    <div class="container-x relative">
        <nav class="flex flex-wrap items-center gap-1.5 text-sm text-slate-400" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-white">Home</a>
            @foreach ($crumbs as $label => $url)
                <x-icon name="chevron-right" class="size-3.5" />
                <a href="{{ $url }}" class="hover:text-white">{{ $label }}</a>
            @endforeach
            <x-icon name="chevron-right" class="size-3.5" />
            <span class="text-slate-200">{{ $title }}</span>
        </nav>
        <div @class(['lg:flex lg:items-end lg:justify-between lg:gap-12' => $aside])>
        <div>
        @if ($eyebrow)<p style="--d: 150ms" class="hero-rise eyebrow mt-6 !text-accent-400">{{ $eyebrow }}</p>@endif
        <h1 style="--d: 450ms" class="hero-rise mt-3 max-w-3xl text-4xl font-extrabold !text-white sm:text-5xl">{{ $title }}</h1>
        @if (trim($slot))<p style="--d: 850ms" class="hero-rise mt-4 max-w-2xl text-lg text-slate-300">{{ $slot }}</p>@endif
        </div>
        @if ($aside)
            <div style="--d: 1100ms" class="hero-rise mt-10 shrink-0 lg:mt-0">{{ $aside }}</div>
        @endif
        </div>
    </div>
</section>
