<x-layouts.app title="Projects">
    <x-page-header title="Our projects" eyebrow="Portfolio">
        A look at the work we've completed and the projects currently underway.

        <x-slot:aside>
            <div class="flex items-center gap-5 rounded-3xl border border-white/10 bg-white/5 px-7 py-6 backdrop-blur-sm sm:px-9 sm:py-7">
                <span class="font-display text-6xl font-extrabold leading-none text-accent-400 sm:text-7xl">{{ config('company.projects_count') }}</span>
                <span class="border-l border-white/15 pl-5">
                    <span class="block font-display text-2xl font-bold text-white sm:text-3xl">Projects</span>
                    <span class="mt-1 block text-sm text-slate-300">delivered &amp; underway</span>
                </span>
            </div>
        </x-slot:aside>
    </x-page-header>

    <section class="section">
        <div class="container-x">
            @if ($projects->isEmpty())
                <div class="mx-auto max-w-md py-12 text-center">
                    <span class="mx-auto grid size-14 place-items-center rounded-full bg-slate-100 text-slate-400"><x-icon name="building" class="size-7" /></span>
                    <h2 class="mt-5 text-xl font-bold">Project gallery coming soon</h2>
                    <p class="mt-2 text-slate-600">We're adding photos and details of our {{ config('company.projects_count') }} projects. Have a project in mind? Let's talk.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary mt-6">Start your project</a>
                </div>
            @else
                @if ($categories->count() > 1)
                    <div class="mb-10 flex flex-wrap gap-2" data-filter-bar role="group" aria-label="Filter projects">
                        <button type="button" data-filter="all" aria-pressed="true" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-brand-600 aria-pressed:border-brand-700 aria-pressed:bg-brand-700 aria-pressed:text-white">All</button>
                        @foreach ($categories as $c)
                            <button type="button" data-filter="{{ $c->id }}" aria-pressed="false" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-brand-600 aria-pressed:border-brand-700 aria-pressed:bg-brand-700 aria-pressed:text-white">{{ $c->title }}</button>
                        @endforeach
                    </div>
                @endif
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3" data-filter-grid>
                    @foreach ($projects as $project)
                        <x-project-card :project="$project" />
                    @endforeach
                </div>
                <p class="hidden py-12 text-center text-slate-500" data-filter-empty>No projects in this category yet.</p>
            @endif
        </div>
    </section>

    <x-cta />
</x-layouts.app>
