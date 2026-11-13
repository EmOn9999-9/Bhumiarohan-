<section class="section pt-0">
    <div class="container-x">
        <div class="relative overflow-hidden rounded-3xl bg-brand-900 px-6 py-12 sm:px-12 sm:py-16 reveal">
            <div class="pattern-grid absolute inset-0" aria-hidden="true"></div>
            <div class="absolute -bottom-24 -left-16 size-80 rounded-full bg-brand-500/25 blur-3xl" aria-hidden="true"></div>
            <div class="relative flex flex-col items-start justify-between gap-8 lg:flex-row lg:items-center">
                <div class="max-w-xl">
                    <h2 class="text-3xl font-bold !text-white sm:text-4xl">Have a project in mind?</h2>
                    <p class="mt-3 text-slate-300">Tell us about it. Our engineers will get back to you with honest advice and a clear estimate, free of charge.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}" class="btn btn-accent">Get a free quote <x-icon name="arrow-right" class="size-4" /></a>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('company.phone')) }}" class="btn btn-ghost-light"><x-icon name="phone" class="size-4" /> {{ config('company.phone') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
