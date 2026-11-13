<x-layouts.app title="About Us">
    <x-page-header title="About us" eyebrow="Who we are">
        A young Nepali engineering company built on technical skill, honesty and a commitment to quality.
    </x-page-header>

    <section class="section">
        <div class="container-x grid items-start gap-12 lg:grid-cols-2">
            <div class="reveal">
                <p class="eyebrow">Our story</p>
                <h2 class="mt-3 text-3xl font-bold sm:text-4xl">Rising from the ground up</h2>
                <div class="mt-6 space-y-4 leading-relaxed text-slate-600">
                    <p><strong class="text-slate-900">{{ config('company.name') }}</strong>: <em>Bhumi</em> means land, and <em>Arohan</em> means ascent. Our name reflects what we do: we take a piece of land and help it rise into something safe, useful and lasting.</p>
                    <p>The company was founded by <strong class="text-slate-900">{{ config('company.owner') }}</strong>, who saw how often construction projects in Nepal suffer from poor planning, unclear costs and shortcuts in safety. We set out to build a company that does things properly, with sound engineering, transparent dealings and respect for our clients' investment.</p>
                    <p>Today we offer a full range of services, from land survey and lab testing to design, construction, interiors, real estate and material supply, so every stage of a project is handled by one accountable team.</p>
                </div>
            </div>
            <x-media src="" alt="{{ config('company.name') }} office" icon="building" label="About image" class="aspect-[4/3] w-full rounded-3xl reveal" />
        </div>
    </section>

    <section class="section bg-slate-50">
        <div class="container-x grid gap-6 md:grid-cols-2">
            <div class="card p-8 reveal">
                <span class="grid size-12 place-items-center rounded-xl bg-brand-700 text-white"><x-icon name="sparkles" /></span>
                <h3 class="mt-5 text-2xl font-bold">Our mission</h3>
                <p class="mt-3 leading-relaxed text-slate-600">To deliver safe, durable and cost-effective engineering solutions through qualified people, modern methods and complete transparency, earning trust one project at a time.</p>
            </div>
            <div class="card p-8 reveal">
                <span class="grid size-12 place-items-center rounded-xl bg-accent-500 text-slate-900"><x-icon name="eye" /></span>
                <h3 class="mt-5 text-2xl font-bold">Our vision</h3>
                <p class="mt-3 leading-relaxed text-slate-600">To become one of Nepal's most trusted engineering and construction companies, known for quality, integrity and contributing to resilient communities across the country.</p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-x">
            <x-section-heading eyebrow="Our values" title="What we stand for" center />
            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['shield', 'Integrity', 'Honest advice, clear contracts and no hidden costs.'],
                    ['check-circle', 'Quality', 'Proper engineering, tested materials, careful workmanship.'],
                    ['users', 'Client focus', 'We listen first and keep you informed throughout.'],
                    ['clock', 'Accountability', 'We own our commitments, schedules and results.'],
                ] as [$icon, $heading, $text])
                    <div class="card p-6 text-center reveal">
                        <span class="mx-auto grid size-12 place-items-center rounded-full bg-brand-50 text-brand-700"><x-icon :name="$icon" /></span>
                        <h3 class="mt-4 font-bold">{{ $heading }}</h3>
                        <p class="mt-2 text-sm text-slate-600">{{ $text }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if (config('company.registration_pending'))
        <section class="pb-16">
            <div class="container-x">
                <div class="flex items-start gap-4 rounded-2xl border border-accent-500/30 bg-accent-500/10 p-5 text-sm text-slate-700 reveal">
                    <x-icon name="document" class="size-5 shrink-0 text-accent-600" />
                    <p><strong class="text-slate-900">Registration status:</strong> {{ config('company.legal_name') }} is currently in the process of being registered with the Office of the Company Registrar, Government of Nepal. Registration details will be published here once complete.</p>
                </div>
            </div>
        </section>
    @endif

    @if ($team->isNotEmpty())
        <section class="section bg-slate-50">
            <div class="container-x">
                <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
                    <x-section-heading eyebrow="Our people" title="Meet the team" />
                    <a href="{{ route('team') }}" class="btn btn-outline shrink-0">Full team</a>
                </div>
                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($team as $member)
                        @include('pages.partials.team-card')
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-cta />
</x-layouts.app>
