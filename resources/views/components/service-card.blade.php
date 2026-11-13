@props(['service'])
<a href="{{ route('services.show', $service) }}" class="card card-hover group flex flex-col p-6 reveal">
    <span class="grid size-12 place-items-center rounded-xl bg-brand-50 text-brand-700 transition group-hover:bg-brand-700 group-hover:text-white">
        <x-icon :name="$service->icon" />
    </span>
    <h3 class="mt-5 text-lg font-bold">{{ $service->title }}</h3>
    <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-600">{{ $service->short_description }}</p>
    <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-700">
        Learn more <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" />
    </span>
</a>
