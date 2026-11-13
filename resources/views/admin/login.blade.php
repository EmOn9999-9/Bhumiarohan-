<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin login | {{ config('company.name') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">
    @fonts
    @vite(['resources/css/app.css'])
</head>
<body class="grid min-h-screen place-items-center bg-slate-50 p-4">
    <div class="w-full max-w-sm">
        <div class="flex justify-center"><x-logo /></div>
        <div class="card mt-8 p-8 shadow-xl shadow-slate-900/5">
            <h1 class="text-xl font-bold">Admin sign in</h1>
            <p class="mt-1 text-sm text-slate-500">Manage your website content.</p>
            <form method="POST" action="{{ route('admin.login.attempt') }}" class="mt-6 space-y-4">
                @csrf
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-input" required autofocus autocomplete="username">
                    @error('email')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" type="password" class="form-input" required autocomplete="current-password">
                </div>
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-brand-700"> Remember me
                </label>
                <button class="btn btn-primary w-full py-3">Sign in</button>
            </form>
        </div>
        <p class="mt-6 text-center text-sm"><a href="{{ route('home') }}" class="text-slate-500 hover:text-slate-800">&larr; Back to website</a></p>
    </div>
</body>
</html>
