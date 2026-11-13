@php
$nav = [
    'Home' => 'home',
    'About' => 'about',
    'Services' => 'services.*',
    'Projects' => 'projects.*',
    'Team' => 'team',
    'Unit Converter' => 'converter',
    'Contact' => 'contact',
];
$url = fn ($r) => route(str_replace('.*', '.index', $r));
@endphp
<header id="site-header" class="fixed inset-x-0 top-0 z-50 transition duration-300">
    <div class="container-x flex h-18 items-center justify-between gap-6 py-3">
        <x-logo class="header-logo" swap />

        <nav class="hidden items-center gap-1 xl:flex" aria-label="Main">
            @foreach ($nav as $label => $route)
                <a href="{{ $url($route) }}"
                   @class(['nav-link whitespace-nowrap rounded-full px-3.5 py-2 text-sm font-medium transition',
                           'is-active' => request()->routeIs($route)])
                   @if (request()->routeIs($route)) aria-current="page" @endif>{{ $label }}</a>
            @endforeach
        </nav>

        <div class="flex items-center gap-2">
            <a href="{{ route('contact') }}" class="btn btn-accent hidden whitespace-nowrap sm:inline-flex">Get a Quote</a>
            <button type="button" id="menu-toggle" class="nav-link grid size-10 place-items-center rounded-full xl:hidden" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu">
                <x-icon name="menu" class="size-6 icon-open" />
                <x-icon name="x" class="size-6 icon-close hidden" />
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="hidden border-t border-slate-200 bg-white shadow-lg xl:hidden">
        <nav class="container-x flex flex-col py-3" aria-label="Mobile">
            @foreach ($nav as $label => $route)
                <a href="{{ $url($route) }}" @class(['rounded-lg px-3 py-3 text-base font-medium',
                    'bg-brand-50 text-brand-700' => request()->routeIs($route),
                    'text-slate-700 hover:bg-slate-50' => ! request()->routeIs($route)])>{{ $label }}</a>
            @endforeach
            <a href="{{ route('contact') }}" class="btn btn-accent mt-3">Get a Quote</a>
        </nav>
    </div>
</header>
