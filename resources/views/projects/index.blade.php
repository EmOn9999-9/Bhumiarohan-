<x-layouts.app title="Projects">
    <x-page-header title="Our projects" eyebrow="Portfolio">
        A look at the work we've completed and the projects currently underway.
    </x-page-header>

    <section class="section">
        <div class="container-x">
            @if ($projects->isEmpty())
                <div class="mx-auto max-w-md py-12 text-center">
                    <span class="mx-auto grid size-14 place-items-center rounded-full bg-slate-100 text-slate-400"><x-icon name="building" class="size-7" /></span>
                    <h2 class="mt-5 text-xl font-bold">Projects coming soon</h2>
                    <p class="mt-2 text-slate-600">We're a new company and our project portfolio is being prepared. Want to be one of our first clients?</p>
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
