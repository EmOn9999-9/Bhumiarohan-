@props(['eyebrow' => null, 'title', 'center' => false, 'light' => false])
<div {{ $attributes->merge(['class' => ($center ? 'mx-auto max-w-2xl text-center' : 'max-w-2xl').' reveal']) }}>
    @if ($eyebrow)<p class="eyebrow {{ $light ? '!text-accent-400' : '' }}">{{ $eyebrow }}</p>@endif
    <h2 class="mt-3 text-3xl font-bold sm:text-4xl {{ $light ? '!text-white' : '' }}">{{ $title }}</h2>
    @if (trim($slot))<p class="mt-4 text-base leading-relaxed {{ $light ? 'text-slate-300' : 'text-slate-600' }}">{{ $slot }}</p>@endif
</div>
