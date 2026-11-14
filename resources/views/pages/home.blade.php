<x-layouts.app>
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-brand-950">
        <img src="{{ asset('images/hero-construction.jpg') }}"
             srcset="{{ asset('images/hero-construction-960.jpg') }} 960w, {{ asset('images/hero-construction.jpg') }} 1920w"
             sizes="100vw" alt="" fetchpriority="high" decoding="async"
             class="hero-bg absolute inset-0 size-full object-cover object-[70%_center]" aria-hidden="true">
        {{-- Overlay keeps the text readable: strongest on the text side, lighter where the cranes are. --}}
        <div class="absolute inset-0 bg-linear-to-r from-brand-950/95 via-brand-950/80 to-brand-950/55 lg:via-brand-950/70 lg:to-brand-950/20" aria-hidden="true"></div>
        <div class="absolute inset-x-0 bottom-0 h-40 bg-linear-to-t from-brand-950/70 to-transparent" aria-hidden="true"></div>

        <div class="container-x relative grid items-center gap-12 pt-32 pb-20 sm:pt-40 lg:grid-cols-12 lg:pb-28">
            <div class="lg:col-span-7">
                <p style="--d: 200ms" class="hero-rise inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-3 py-1 text-xs font-medium text-slate-300">
                    <span class="size-1.5 rounded-full bg-accent-400"></span> Engineering firm based in Nepal
                </p>
                <h1 style="--d: 600ms" class="hero-rise mt-6 text-4xl font-extrabold leading-[1.08] !text-white sm:text-5xl lg:text-6xl">
                    Building spaces. Creating value. <span class="text-accent-400">Elevating lives.</span>
                </h1>
                <p style="--d: 1000ms" class="hero-rise mt-6 max-w-xl text-lg leading-relaxed text-slate-300">
                    {{ config('company.name') }} brings together construction, design, survey and infrastructure expertise
                    under one roof, delivering safe, durable and well-engineered projects from the ground up.
                </p>
                <div style="--d: 1400ms" class="hero-rise mt-9 flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}" class="btn btn-accent px-6 py-3">Get a free consultation <x-icon name="arrow-right" class="size-4" /></a>
                    <a href="{{ route('services.index') }}" class="btn btn-ghost-light px-6 py-3">Explore services</a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <div class="grid grid-cols-2 gap-3">
                    @foreach ($services->take(4) as $s)
                        <a href="{{ route('services.show', $s) }}" style="--d: {{ 1700 + $loop->index * 200 }}ms" class="hero-rise group rounded-2xl border border-white/10 bg-white/5 p-5 backdrop-blur transition hover:border-white/25 hover:bg-white/10">
                            <x-icon :name="$s->icon" class="size-7 text-accent-400" />
                            <p class="mt-4 text-sm font-semibold leading-snug text-white">{{ $s->title }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Intro --}}
    <section class="section">
        <div class="container-x grid items-center gap-12 lg:grid-cols-2">
            <div class="relative reveal">
                <x-media src="" alt="{{ config('company.name') }} team at work" icon="building" label="Company image" class="aspect-[4/3] w-full rounded-3xl" />
                <div class="absolute -bottom-6 right-6 hidden rounded-2xl bg-white p-5 shadow-xl shadow-brand-900/10 sm:block">
                    <p class="font-display text-3xl font-extrabold text-brand-700">8</p>
                    <p class="text-sm text-slate-600">Integrated services</p>
                </div>
            </div>
            <div class="reveal">
                <p class="eyebrow">Who we are</p>
                <h2 class="mt-3 text-3xl font-bold sm:text-4xl">One team for every stage of your project</h2>
                <div class="mt-5 space-y-4 leading-relaxed text-slate-600">
                    <p>We are a new engineering company founded by qualified engineers who believe construction in Nepal deserves more transparency, better planning and higher standards of safety.</p>
                    <p>From the first survey and soil test to the design, construction and interior finish, we handle it all, so you deal with one accountable team instead of many.</p>
                </div>
                <ul class="mt-6 grid gap-3 sm:grid-cols-2">
                    @foreach (['NBC-compliant designs', 'Qualified engineers', 'Transparent costing', 'End-to-end delivery'] as $point)
                        <li class="flex items-center gap-2.5 text-sm font-medium text-slate-800">
                            <x-icon name="check-circle" class="size-5 text-brand-600" /> {{ $point }}
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('about') }}" class="btn btn-outline mt-8">More about us <x-icon name="arrow-right" class="size-4" /></a>
            </div>
        </div>
    </section>

    {{-- Services --}}
    <section class="section bg-slate-50">
        <div class="container-x">
            <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
                <x-section-heading eyebrow="What we do" title="Our services">
                    Complete engineering and construction solutions, from planning to handover.
                </x-section-heading>
                <a href="{{ route('services.index') }}" class="btn btn-outline shrink-0">All services</a>
            </div>
            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($services as $service)
                    <x-service-card :service="$service" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why choose us --}}
    <section class="section">
        <div class="container-x grid gap-12 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <x-section-heading eyebrow="Why choose us" title="Engineering you can trust">
                    We may be new, but our engineers bring hands-on experience and a commitment to doing things right.
                </x-section-heading>
                <a href="{{ route('contact') }}" class="btn btn-primary mt-8 reveal">Talk to an engineer</a>
            </div>
            <div class="grid gap-5 sm:grid-cols-2 lg:col-span-8">
                @foreach ([
                    ['users', 'Qualified team', 'Licensed engineers and skilled technicians handle every project, not middlemen.'],
                    ['document', 'Transparent pricing', 'Detailed estimates and clear contracts, with no hidden costs or surprise bills.'],
                    ['clock', 'On-time delivery', 'Realistic schedules, proper planning and regular progress updates.'],
                    ['shield', 'Safety & compliance', 'Earthquake-resistant design and strict adherence to the National Building Code.'],
                    ['sparkles', 'Quality materials', 'Tested, certified materials, backed by our own survey and lab services.'],
                    ['briefcase', 'One-stop solution', 'Survey, design, construction, interiors and supply, all from one team.'],
                ] as [$icon, $heading, $text])
                    <div class="flex gap-4 rounded-2xl p-5 transition hover:bg-slate-50 reveal">
                        <span class="grid size-11 shrink-0 place-items-center rounded-xl bg-accent-500/15 text-accent-600">
                            <x-icon :name="$icon" class="size-5" />
                        </span>
                        <div>
                            <h3 class="font-bold">{{ $heading }}</h3>
                            <p class="mt-1.5 text-sm leading-relaxed text-slate-600">{{ $text }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Process --}}
    <section class="section bg-brand-950 relative overflow-hidden">
        <div class="pattern-grid absolute inset-0" aria-hidden="true"></div>
        <div class="container-x relative">
            <x-section-heading eyebrow="How we work" title="A simple, clear process" center light>
                Every project follows the same proven steps, so you always know what comes next.
            </x-section-heading>
            <ol class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['Consultation', 'We listen to your needs, visit the site and understand your budget.'],
                    ['Survey & design', 'Site survey, soil testing, and architectural & structural design.'],
                    ['Construction', 'Skilled execution with on-site engineering supervision.'],
                    ['Handover', 'Final inspection, documentation and after-handover support.'],
                ] as $i => [$step, $text])
                    <li class="relative rounded-2xl border border-white/10 bg-white/5 p-6 reveal">
                        <span class="font-display text-4xl font-extrabold text-accent-400/90">0{{ $i + 1 }}</span>
                        <h3 class="mt-4 text-lg font-bold !text-white">{{ $step }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-400">{{ $text }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Projects --}}
    @if ($projects->isNotEmpty())
        <section class="section">
            <div class="container-x">
                <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
                    <x-section-heading eyebrow="Our work" title="Recent projects" />
                    <a href="{{ route('projects.index') }}" class="btn btn-outline shrink-0">View all projects</a>
                </div>
                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($projects as $project)
                        <x-project-card :project="$project" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Converter teaser --}}
    <section class="section {{ $projects->isNotEmpty() ? 'pt-0' : '' }}">
        <div class="container-x">
            <div class="card flex flex-col items-start gap-6 p-8 sm:flex-row sm:items-center sm:justify-between reveal">
                <div class="flex items-start gap-4">
                    <span class="grid size-12 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-700"><x-icon name="calculator" /></span>
                    <div>
                        <h3 class="text-xl font-bold">Nepali land unit converter</h3>
                        <p class="mt-1 text-sm text-slate-600">Convert Ropani, Aana, Bigha, Kattha, Dhur to square feet and metres instantly.</p>
                    </div>
                </div>
                <a href="{{ route('converter') }}" class="btn btn-primary shrink-0">Open converter</a>
            </div>
        </div>
    </section>

    <x-cta />
</x-layouts.app>
