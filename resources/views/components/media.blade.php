{{-- Shows an uploaded image, or a neutral placeholder until one is provided. --}}
@props(['src' => null, 'alt' => '', 'icon' => 'photo', 'label' => null])
@if ($src)
    <img src="{{ \Illuminate\Support\Str::startsWith($src, ['http', '/']) ? $src : asset('storage/'.$src) }}" alt="{{ $alt }}" loading="lazy" {{ $attributes->merge(['class' => 'object-cover']) }}>
@else
    <div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center gap-2 bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400']) }} role="img" aria-label="{{ $alt }}">
        <x-icon :name="$icon" class="size-10" />
        @if ($label)<span class="text-xs font-medium">{{ $label }}</span>@endif
    </div>
@endif
