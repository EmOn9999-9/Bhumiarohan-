@props(['title' => null, 'description' => null])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($title) ? $title.' | '.config('company.name') : config('company.name').' | '.config('company.tagline') }}</title>
    <meta name="description" content="{{ $description ?? config('company.description') }}">
    <meta property="og:title" content="{{ $title ?? config('company.name') }}">
    <meta property="og:description" content="{{ $description ?? config('company.description') }}">
    <meta property="og:type" content="website">
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col">
    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-lg focus:bg-white focus:px-4 focus:py-2 focus:shadow">Skip to content</a>
    <x-header />
    <main id="main" class="flex-1">
        {{ $slot }}
    </main>
    <x-footer />
</body>
</html>
