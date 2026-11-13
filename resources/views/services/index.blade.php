<x-layouts.app title="Our Services">
    <x-page-header title="Our services" eyebrow="What we do">
        Engineering, construction and design services covering every stage of your project.
    </x-page-header>

    <section class="section">
        <div class="container-x grid gap-6 md:grid-cols-2">
            @foreach ($services as $service)
                <a href="{{ route('services.show', $service) }}" class="card card-hover group flex flex-col gap-6 p-6 sm:flex-row sm:p-8 reveal">
                    <span class="grid size-14 shrink-0 place-items-center rounded-2xl bg-brand-50 text-brand-700 transition group-hover:bg-brand-700 group-hover:text-white">
                        <x-icon :name="$service->icon" class="size-7" />
                    </span>
                    <div class="flex-1">
                        <h2 class="text-xl font-bold group-hover:text-brand-700">{{ $service->title }}</h2>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $service->short_description }}</p>
                        @if ($service->features)
                            <ul class="mt-4 grid gap-1.5 text-sm text-slate-700 sm:grid-cols-2">
                                @foreach (array_slice($service->features, 0, 4) as $f)
                                    <li class="flex items-center gap-2"><x-icon name="check" class="size-4 shrink-0 text-brand-600" /> {{ $f }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-700">Learn more <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" /></span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <x-cta />
</x-layouts.app>
