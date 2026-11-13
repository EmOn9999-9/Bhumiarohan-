@props(['title' => 'Dashboard'])
@php
$links = [
    ['Dashboard', 'admin.dashboard', 'grid'],
    ['Projects', 'admin.projects.*', 'building'],
    ['Services', 'admin.services.*', 'briefcase'],
    ['Team', 'admin.team.*', 'users'],
    ['Inquiries', 'admin.inquiries.*', 'inbox'],
    ['Password', 'admin.password.*', 'key'],
];
$unread = \App\Models\Inquiry::where('is_read', false)->count();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title }} | Admin | {{ config('company.name') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    @fonts
    @vite(['resources/css/app.css', 'resources/js/admin.js'])
</head>
<body class="bg-slate-50">
    <div class="lg:flex">
        <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-40 hidden w-64 flex-col border-r border-slate-200 bg-white lg:flex">
            <div class="flex h-16 items-center border-b border-slate-200 px-5"><x-logo /></div>
            <nav class="flex-1 space-y-1 p-3">
                @foreach ($links as [$label, $route, $icon])
                    <a href="{{ route(str_replace('.*', '.index', str_replace('password.*', 'password.edit', $route))) }}"
                       @class(['flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition',
                               'bg-brand-50 text-brand-700' => request()->routeIs($route),
                               'text-slate-600 hover:bg-slate-50 hover:text-slate-900' => ! request()->routeIs($route)])>
                        <x-icon :name="$icon" class="size-5" />
                        <span class="flex-1">{{ $label }}</span>
                        @if ($label === 'Inquiries' && $unread)
                            <span class="rounded-full bg-accent-500 px-2 py-0.5 text-xs font-semibold text-slate-900">{{ $unread }}</span>
                        @endif
                    </a>
                @endforeach
            </nav>
            <div class="space-y-1 border-t border-slate-200 p-3">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50"><x-icon name="external" class="size-5" /> View website</a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-50"><x-icon name="logout" class="size-5" /> Log out</button>
                </form>
            </div>
        </aside>

        <div class="flex-1 lg:pl-64">
            <header class="sticky top-0 z-30 flex h-16 items-center justify-between gap-4 border-b border-slate-200 bg-white/90 px-4 backdrop-blur sm:px-8">
                <div class="flex items-center gap-3">
                    <button type="button" id="admin-menu" class="grid size-10 place-items-center rounded-lg text-slate-600 hover:bg-slate-100 lg:hidden" aria-label="Toggle menu"><x-icon name="menu" /></button>
                    <h1 class="text-lg font-bold">{{ $title }}</h1>
                </div>
                @isset($actions)<div class="flex items-center gap-2">{{ $actions }}</div>@endisset
            </header>
            <main class="p-4 sm:p-8">
                @if (session('success'))
                    <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                        <x-icon name="check-circle" class="size-5" /> {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                        Please fix the errors below.
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
    </div>
    <div id="admin-overlay" class="fixed inset-0 z-30 hidden bg-slate-900/40 lg:hidden"></div>
</body>
</html>
