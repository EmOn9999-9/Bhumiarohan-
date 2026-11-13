<x-layouts.app :title="$service->title" :description="$service->short_description">
    <x-page-header :title="$service->title" eyebrow="Service" :crumbs="['Services' => route('services.index')]">
        {{ $service->short_description }}
    </x-page-header>

    <section class="section">
        <div class="container-x grid gap-12 lg:grid-cols-12">
            <article class="lg:col-span-8">
                @if ($service->image)
                    <x-media :src="$service->image" :alt="$service->title" class="mb-10 aspect-[16/9] w-full rounded-3xl" />
                @endif
                <div class="prose-body text-lg text-slate-600 reveal">
                    @foreach (preg_split('/\n\s*\n/', trim($service->description ?? '')) as $para)
                        <p>{{ $para }}</p>
                    @endforeach
                </div>

                @if ($service->features)
                    <h2 class="mt-12 text-2xl font-bold reveal">What's included</h2>
                    <ul class="mt-6 grid gap-3 sm:grid-cols-2">
                        @foreach ($service->features as $f)
                            <li class="flex items-start gap-3 rounded-xl border border-slate-200 p-4 text-sm font-medium text-slate-800 reveal">
                                <span class="grid size-6 shrink-0 place-items-center rounded-full bg-brand-700 text-white"><x-icon name="check" class="size-3.5" /></span>
                                {{ $f }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if ($projects->isNotEmpty())
                    <h2 class="mt-14 text-2xl font-bold">Related projects</h2>
                    <div class="mt-6 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
                        @foreach ($projects as $project)
                            <x-project-card :project="$project" />
                        @endforeach
                    </div>
                @endif
            </article>

            <aside class="space-y-6 lg:col-span-4">
                <div class="rounded-3xl bg-brand-900 p-7 text-white">
                    <h2 class="text-xl font-bold !text-white">Interested in this service?</h2>
                    <p class="mt-2 text-sm text-slate-300">Get a free consultation and estimate from our engineers.</p>
                    <a href="{{ route('contact', ['service' => $service->title]) }}" class="btn btn-accent mt-5 w-full">Request a quote</a>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('company.phone')) }}" class="mt-3 flex items-center justify-center gap-2 text-sm text-slate-300 hover:text-white">
                        <x-icon name="phone" class="size-4" /> {{ config('company.phone') }}
                    </a>
                </div>
                <div class="card p-6">
                    <h2 class="font-bold">Other services</h2>
                    <ul class="mt-3 divide-y divide-slate-100">
                        @foreach ($others as $o)
                            <li>
                                <a href="{{ route('services.show', $o) }}" class="group flex items-center gap-3 py-3 text-sm font-medium text-slate-700 hover:text-brand-700">
                                    <x-icon :name="$o->icon" class="size-5 text-slate-400 group-hover:text-brand-600" />
                                    <span class="flex-1">{{ $o->title }}</span>
                                    <x-icon name="chevron-right" class="size-4 text-slate-300" />
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </section>
</x-layouts.app>
