<x-layouts.app title="Contact Us">
    <x-page-header title="Contact us" eyebrow="Get in touch">
        Tell us about your project. We usually reply within one working day.
    </x-page-header>

    <section class="section">
        <div class="container-x grid gap-10 lg:grid-cols-12">
            <div class="space-y-4 lg:col-span-4">
                <div class="card flex items-start gap-4 p-5 reveal">
                    <span class="grid size-11 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-700"><x-icon name="phone" class="size-5" /></span>
                    <div class="min-w-0">
                        <p class="text-sm text-slate-500">Call us</p>
                        @foreach (array_filter([config('company.phone'), config('company.phone_alt')]) as $number)
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $number) }}" class="block font-semibold text-slate-900 hover:text-brand-700">{{ $number }}</a>
                        @endforeach
                    </div>
                </div>
                @foreach ([
                    ['mail', 'Email us', config('company.email'), 'mailto:'.config('company.email')],
                    ['pin', 'Visit us', config('company.address'), null],
                    ['clock', 'Office hours', config('company.hours'), null],
                ] as [$icon, $label, $value, $href])
                    <div class="card flex items-start gap-4 p-5 reveal">
                        <span class="grid size-11 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-700"><x-icon :name="$icon" class="size-5" /></span>
                        <div class="min-w-0">
                            <p class="text-sm text-slate-500">{{ $label }}</p>
                            @if ($href)
                                <a href="{{ $href }}" class="break-words font-semibold text-slate-900 hover:text-brand-700">{{ $value }}</a>
                            @else
                                <p class="font-semibold text-slate-900">{{ $value }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="scroll-mt-24 lg:col-span-8" id="contact-form">
                <div class="card p-6 sm:p-10">
                    <h2 class="text-2xl font-bold">Send us a message</h2>
                    <p class="mt-1 text-sm text-slate-600">Fields marked * are required.</p>

                    @if (session('success'))
                        <div class="mt-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800" role="status">
                            <x-icon name="check-circle" class="size-5 shrink-0" /> {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="mt-8 grid gap-5 sm:grid-cols-2" data-once novalidate>
                        @csrf
                        <div class="hidden" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>

                        <div>
                            <label for="name" class="form-label">Full name *</label>
                            <input id="name" name="name" value="{{ old('name') }}" class="form-input" required autocomplete="name">
                            @error('name')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="phone" class="form-label">Phone number *</label>
                            <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" class="form-input" required autocomplete="tel" placeholder="98XXXXXXXX">
                            @error('phone')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-input" autocomplete="email">
                            @error('email')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="service" class="form-label">Service of interest</label>
                            <select id="service" name="service" class="form-input">
                                <option value="">Select a service</option>
                                @foreach ($services as $s)
                                    <option @selected(old('service', $selected) === $s)>{{ $s }}</option>
                                @endforeach
                                <option @selected(old('service') === 'Other')>Other</option>
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="message" class="form-label">Your message *</label>
                            <textarea id="message" name="message" rows="5" class="form-input" required placeholder="Briefly describe your project: location, size, timeline…">{{ old('message') }}</textarea>
                            @error('message')<p class="form-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="sm:col-span-2">
                            <button type="submit" class="btn btn-primary px-7 py-3">Send message <x-icon name="arrow-right" class="size-4" /></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if (config('company.map_embed'))
        <section class="pb-16 sm:pb-24">
            <div class="container-x">
                <div class="overflow-hidden rounded-3xl border border-slate-200 reveal">
                    <iframe src="{{ config('company.map_embed') }}" class="h-80 w-full sm:h-96" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Office location map"></iframe>
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
