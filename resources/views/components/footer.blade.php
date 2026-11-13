@php $services = \App\Models\Service::active()->get(['title', 'slug']); @endphp
<footer class="bg-brand-950 text-slate-400">
    <div class="container-x grid gap-12 py-16 sm:grid-cols-2 lg:grid-cols-12">
        <div class="lg:col-span-4">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3" aria-label="{{ config('company.name') }} home">
                <img src="{{ asset('images/logo-mark-light.png') }}" alt="" width="240" height="215" class="h-14 w-auto">
                <span class="leading-tight">
                    <span class="block font-display text-xl font-extrabold uppercase tracking-wide text-white">Bhumi <span class="text-accent-400">Arohan</span></span>
                    <span class="block text-[10px] font-semibold uppercase tracking-[0.12em] text-slate-400">Engineering &amp; Construction Pvt. Ltd.</span>
                </span>
            </a>
            <p class="mt-4 text-xs font-semibold uppercase tracking-[0.14em] text-accent-400">{{ config('company.tagline') }}</p>
            <p class="mt-5 max-w-sm text-sm leading-relaxed">{{ config('company.description') }}</p>
            <div class="mt-6 flex gap-2">
                @foreach (array_filter(config('company.social')) as $name => $link)
                    <a href="{{ $name === 'whatsapp' ? 'https://wa.me/'.preg_replace('/\D/', '', $link) : $link }}" target="_blank" rel="noopener"
                       class="rounded-full border border-white/15 px-3 py-1.5 text-xs font-medium capitalize text-slate-300 transition hover:border-white/40 hover:text-white">{{ $name }}</a>
                @endforeach
            </div>
        </div>

        <div class="lg:col-span-2">
            <h3 class="text-sm font-semibold !text-white">Company</h3>
            <ul class="mt-4 space-y-2.5 text-sm">
                <li><a href="{{ route('about') }}" class="hover:text-white">About us</a></li>
                <li><a href="{{ route('projects.index') }}" class="hover:text-white">Projects</a></li>
                <li><a href="{{ route('team') }}" class="hover:text-white">Our team</a></li>
                <li><a href="{{ route('converter') }}" class="hover:text-white">Unit converter</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
            </ul>
        </div>

        <div class="lg:col-span-3">
            <h3 class="text-sm font-semibold !text-white">Services</h3>
            <ul class="mt-4 space-y-2.5 text-sm">
                @foreach ($services as $s)
                    <li><a href="{{ route('services.show', $s) }}" class="hover:text-white">{{ $s->title }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="lg:col-span-3">
            <h3 class="text-sm font-semibold !text-white">Get in touch</h3>
            <ul class="mt-4 space-y-3 text-sm">
                <li class="flex gap-3"><x-icon name="pin" class="size-5 shrink-0 text-accent-400" /> {{ config('company.address') }}</li>
                <li class="flex gap-3"><x-icon name="phone" class="size-5 shrink-0 text-accent-400" /> <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('company.phone')) }}" class="hover:text-white">{{ config('company.phone') }}</a></li>
                @if (config('company.phone_alt'))
                    <li class="flex gap-3"><x-icon name="phone" class="size-5 shrink-0 text-accent-400" /> <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('company.phone_alt')) }}" class="hover:text-white">{{ config('company.phone_alt') }}</a></li>
                @endif
                <li class="flex gap-3"><x-icon name="mail" class="size-5 shrink-0 text-accent-400" /> <a href="mailto:{{ config('company.email') }}" class="break-all hover:text-white">{{ config('company.email') }}</a></li>
                <li class="flex gap-3"><x-icon name="clock" class="size-5 shrink-0 text-accent-400" /> {{ config('company.hours') }}</li>
            </ul>
        </div>
    </div>
    <div class="border-t border-white/10">
        <div class="container-x flex flex-col gap-2 py-6 text-xs sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} {{ config('company.legal_name') }}. All rights reserved.</p>
            @if (! config('company.registration_pending') && config('company.registration_no'))
                <p class="text-slate-500">Reg. No. {{ config('company.registration_no') }}</p>
            @endif
        </div>
    </div>
</footer>
