<x-layouts.app :title="$project->title" :description="\Illuminate\Support\Str::limit(strip_tags($project->description), 155)">
    <x-page-header :title="$project->title" :eyebrow="$project->service?->title ?? 'Project'" :crumbs="['Projects' => route('projects.index')]" />

    <section class="section">
        <div class="container-x grid gap-12 lg:grid-cols-12">
            <article class="lg:col-span-8">
                <x-media :src="$project->cover_image" :alt="$project->title" label="Project image" class="aspect-[16/9] w-full rounded-3xl" />

                @if ($project->description)
                    <div class="prose-body mt-10 text-lg text-slate-600">
                        @foreach (preg_split('/\n\s*\n/', trim($project->description)) as $para)
                            <p>{!! nl2br(e($para)) !!}</p>
                        @endforeach
                    </div>
                @endif

                @if ($project->images->isNotEmpty())
                    <h2 class="mt-12 text-2xl font-bold">Gallery</h2>
                    <div class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-3">
                        @foreach ($project->images as $img)
                            <a href="{{ asset('storage/'.$img->path) }}" data-lightbox data-alt="{{ $project->title }} photo {{ $loop->iteration }}" class="group block overflow-hidden rounded-2xl focus-visible:outline-2 focus-visible:outline-brand-500">
                                <img src="{{ asset('storage/'.$img->path) }}" alt="{{ $project->title }} photo {{ $loop->iteration }}" loading="lazy" class="aspect-square w-full object-cover transition duration-500 group-hover:scale-105">
                            </a>
                        @endforeach
                    </div>
                @endif
            </article>

            <aside class="lg:col-span-4">
                <div class="card sticky top-24 p-6">
                    <h2 class="text-lg font-bold">Project details</h2>
                    <dl class="mt-4 divide-y divide-slate-100 text-sm">
                        @foreach (array_filter([
                            'Status' => $project->status_label,
                            'Service' => $project->service?->title,
                            'Location' => $project->location,
                            'Client' => $project->client,
                            'Year' => $project->year,
                        ]) as $label => $value)
                            <div class="flex justify-between gap-4 py-3">
                                <dt class="text-slate-500">{{ $label }}</dt>
                                <dd class="text-right font-medium text-slate-900">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                    <a href="{{ route('contact', ['service' => $project->service?->title]) }}" class="btn btn-primary mt-6 w-full">Start a similar project</a>
                </div>
            </aside>
        </div>

        @if ($related->isNotEmpty())
            <div class="container-x mt-20">
                <h2 class="text-2xl font-bold">More projects</h2>
                <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($related as $r)
                        <x-project-card :project="$r" />
                    @endforeach
                </div>
            </div>
        @endif
    </section>

    {{-- Lightbox --}}
    <div id="lightbox" class="fixed inset-0 z-[70] hidden items-center justify-center bg-slate-950/90 p-4" role="dialog" aria-modal="true" aria-label="Image viewer">
        <img src="" alt="" class="max-h-[85vh] max-w-full rounded-xl object-contain">
        <button type="button" data-lightbox-close class="absolute right-4 top-4 grid size-11 place-items-center rounded-full bg-white/10 text-white hover:bg-white/20" aria-label="Close"><x-icon name="x" /></button>
        <button type="button" data-lightbox-prev class="absolute left-3 top-1/2 grid size-11 -translate-y-1/2 place-items-center rounded-full bg-white/10 text-white hover:bg-white/20" aria-label="Previous image"><x-icon name="chevron-left" /></button>
        <button type="button" data-lightbox-next class="absolute right-3 top-1/2 grid size-11 -translate-y-1/2 place-items-center rounded-full bg-white/10 text-white hover:bg-white/20" aria-label="Next image"><x-icon name="chevron-right" /></button>
        <p data-lightbox-counter class="absolute bottom-5 left-1/2 -translate-x-1/2 text-sm text-slate-300"></p>
    </div>
</x-layouts.app>
