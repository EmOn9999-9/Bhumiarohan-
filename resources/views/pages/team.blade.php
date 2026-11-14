<x-layouts.app title="Our Team">
    <x-page-header title="Our team" eyebrow="Our people">
        Qualified engineers and professionals committed to getting every detail right.
    </x-page-header>

    {{-- Founder / leadership: each gets a full section --}}
    @foreach ($founders as $founder)
        <section @class(['section', 'bg-slate-50' => $loop->even])>
            <div class="container-x grid items-start gap-10 lg:grid-cols-12 lg:gap-16">
                <div class="lg:col-span-5 reveal">
                    <div class="relative mx-auto max-w-72 sm:max-w-sm lg:max-w-none">
                        <div class="absolute -bottom-4 -right-4 hidden size-full rounded-3xl border-2 border-accent-500/40 sm:block" aria-hidden="true"></div>
                        @if ($founder->photo)
                            <x-media :src="$founder->photo" :alt="$founder->name" class="relative aspect-[4/5] w-full rounded-3xl shadow-xl shadow-brand-900/10" />
                        @else
                            <div class="relative grid aspect-[4/5] w-full place-items-center rounded-3xl bg-linear-to-br from-brand-800 to-brand-950 shadow-xl shadow-brand-900/10">
                                <span class="font-display text-8xl font-extrabold text-white/80">{{ $founder->initials }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-7">
                    <p class="eyebrow">{{ $founder->role }}</p>
                    <h2 class="mt-3 text-4xl font-extrabold sm:text-5xl">{{ $founder->name }}</h2>
                    @if ($founder->qualification)
                        <p class="mt-4 inline-flex items-center gap-2 rounded-full bg-brand-50 px-3.5 py-1.5 text-sm font-semibold text-brand-800">
                            <x-icon name="building" class="size-4" /> {{ $founder->qualification }}
                        </p>
                    @endif

                    @if ($founder->bio)
                        <div class="prose-body mt-6 text-lg text-slate-600 reveal">
                            @foreach (preg_split('/\n\s*\n/', trim($founder->bio)) as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if ($founder->quote)
                        <figure class="relative mt-10 rounded-3xl bg-brand-950 p-8 text-white sm:p-10 reveal">
                            <span class="absolute -top-6 left-8 font-display text-8xl leading-none text-accent-500" aria-hidden="true">&ldquo;</span>
                            <blockquote class="relative font-display text-xl font-semibold leading-relaxed sm:text-2xl">
                                {{ $founder->quote }}
                            </blockquote>
                            <figcaption class="mt-6 flex items-center gap-3 text-sm">
                                <span class="h-px w-8 bg-accent-500"></span>
                                <span><strong class="text-white">{{ $founder->name }}</strong> <span class="text-slate-400">· {{ $founder->role }}</span></span>
                            </figcaption>
                        </figure>
                    @endif

                    @if ($founder->email || $founder->phone)
                        <div class="mt-8 flex flex-wrap gap-3">
                            @if ($founder->email)<a href="mailto:{{ $founder->email }}" class="btn btn-outline"><x-icon name="mail" class="size-4" /> {{ $founder->email }}</a>@endif
                            @if ($founder->phone)<a href="tel:{{ preg_replace('/[^0-9+]/', '', $founder->phone) }}" class="btn btn-outline"><x-icon name="phone" class="size-4" /> {{ $founder->phone }}</a>@endif
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endforeach

    {{-- Rest of the team --}}
    @if ($members->isNotEmpty())
        <section class="section {{ $founders->isNotEmpty() ? 'bg-slate-50' : '' }}">
            <div class="container-x">
                @if ($founders->isNotEmpty())
                    <x-section-heading eyebrow="The people behind our work" title="Meet the team" center />
                @endif
                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($members as $member)
                        @include('pages.partials.team-card', ['full' => true])
                    @endforeach
                </div>
            </div>
        </section>
    @elseif ($founders->isEmpty())
        <section class="section">
            <div class="container-x">
                <div class="mx-auto max-w-md py-12 text-center">
                    <span class="mx-auto grid size-14 place-items-center rounded-full bg-slate-100 text-slate-400"><x-icon name="users" class="size-7" /></span>
                    <h2 class="mt-5 text-xl font-bold">Team profiles coming soon</h2>
                    <p class="mt-2 text-slate-600">We're putting together our team page. In the meantime, feel free to get in touch with us directly.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary mt-6">Contact us</a>
                </div>
            </div>
        </section>
    @endif

    <x-cta />
</x-layouts.app>
