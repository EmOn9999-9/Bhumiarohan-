{{-- Logo: icon mark + wordmark. `swap` shows the white mark until the header turns solid. --}}
@props(['light' => false, 'swap' => false])
<a href="{{ route('home') }}" {{ $attributes->merge(['class' => 'flex items-center gap-2.5']) }} aria-label="{{ config('company.name') }} home">
    @if ($swap)
        <img src="{{ asset('images/logo-mark-light.png') }}" alt="" width="240" height="215" class="logo-mark-light h-10 w-auto shrink-0">
        <img src="{{ asset('images/logo-mark.png') }}" alt="" width="240" height="215" class="logo-mark-color hidden h-10 w-auto shrink-0">
    @else
        <img src="{{ asset($light ? 'images/logo-mark-light.png' : 'images/logo-mark.png') }}" alt="" width="240" height="215" class="h-10 w-auto shrink-0">
    @endif
    <span class="leading-tight">
        <span class="logo-name block whitespace-nowrap font-display text-[17px] font-extrabold uppercase tracking-wide {{ $light ? 'text-white' : 'text-brand-900' }}">Bhumi <span class="text-accent-500">Arohan</span></span>
        <span class="logo-sub block whitespace-nowrap text-[9px] font-semibold uppercase tracking-[0.12em] {{ $light ? 'text-slate-400' : 'text-slate-500' }}">Engineering &amp; Construction Pvt. Ltd.</span>
    </span>
</a>
