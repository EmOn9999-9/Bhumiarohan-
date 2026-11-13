<x-layouts.app title="Our Team">
    <x-page-header title="Our team" eyebrow="Our people">
        Qualified engineers and professionals committed to getting every detail right.
    </x-page-header>

    <section class="section">
        <div class="container-x">
            @if ($team->isEmpty())
                <div class="mx-auto max-w-md py-12 text-center">
                    <span class="mx-auto grid size-14 place-items-center rounded-full bg-slate-100 text-slate-400"><x-icon name="users" class="size-7" /></span>
                    <h2 class="mt-5 text-xl font-bold">Team profiles coming soon</h2>
                    <p class="mt-2 text-slate-600">We're putting together our team page. In the meantime, feel free to get in touch with us directly.</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary mt-6">Contact us</a>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($team as $member)
                        @include('pages.partials.team-card', ['full' => true])
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <x-cta />
</x-layouts.app>
