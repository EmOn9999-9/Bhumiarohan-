<x-layouts.app title="Nepali Land Unit Converter" description="Convert Nepali land measurement units: Ropani, Aana, Paisa, Daam, Bigha, Kattha, Dhur to square feet, square metres and acres.">
    <x-page-header title="Land unit converter" eyebrow="Free tool">
        Convert between Nepal's hilly (Ropani) and Terai (Bigha) land measurement systems and standard units, instantly.
    </x-page-header>

    @php
        $field = fn ($name, $label) => '<label class="block"><span class="form-label">'.$label.'</span><input type="number" inputmode="decimal" min="0" step="any" name="'.$name.'" class="form-input text-base" placeholder="0"></label>';
    @endphp

    <section class="section">
        <div class="container-x grid gap-10 lg:grid-cols-12">
            <form id="converter" class="space-y-6 lg:col-span-8" autocomplete="off">
                <div class="card p-6 sm:p-8">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-xl font-bold">Hilly region</h2>
                            <p class="text-sm text-slate-500">Ropani – Aana – Paisa – Daam</p>
                        </div>
                        <button type="reset" class="btn btn-outline btn-sm">Clear all</button>
                    </div>
                    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-4">
                        {!! $field('ropani', 'Ropani') !!}{!! $field('aana', 'Aana') !!}{!! $field('paisa', 'Paisa') !!}{!! $field('daam', 'Daam') !!}
                    </div>
                </div>

                <div class="flex justify-center text-slate-300" aria-hidden="true"><x-icon name="swap" class="size-6 rotate-90" /></div>

                <div class="card p-6 sm:p-8">
                    <h2 class="text-xl font-bold">Terai region</h2>
                    <p class="text-sm text-slate-500">Bigha – Kattha – Dhur</p>
                    <div class="mt-6 grid grid-cols-3 gap-4">
                        {!! $field('bigha', 'Bigha') !!}{!! $field('kattha', 'Kattha') !!}{!! $field('dhur', 'Dhur') !!}
                    </div>
                </div>

                <div class="card p-6 sm:p-8">
                    <h2 class="text-xl font-bold">Standard units</h2>
                    <div class="mt-6 grid gap-4 sm:grid-cols-3">
                        {!! $field('sqft', 'Square feet (sq.ft)') !!}{!! $field('sqm', 'Square metres (m²)') !!}{!! $field('acre', 'Acres') !!}
                    </div>
                </div>

                <p id="converter-summary" class="rounded-xl bg-brand-50 px-5 py-4 text-sm font-medium text-brand-900" aria-live="polite">Enter a value in any field to convert.</p>
            </form>

            <aside class="lg:col-span-4">
                <div class="card sticky top-24 p-6">
                    <h2 class="text-lg font-bold">Conversion reference</h2>
                    <dl class="mt-4 divide-y divide-slate-100 text-sm">
                        @foreach ([
                            '1 Ropani' => '16 Aana = 5,476 sq.ft = 508.74 m²',
                            '1 Aana' => '4 Paisa = 342.25 sq.ft = 31.80 m²',
                            '1 Paisa' => '4 Daam = 85.56 sq.ft = 7.95 m²',
                            '1 Daam' => '21.39 sq.ft = 1.99 m²',
                            '1 Bigha' => '20 Kattha = 72,900 sq.ft = 6,772.63 m²',
                            '1 Kattha' => '20 Dhur = 3,645 sq.ft = 338.63 m²',
                            '1 Dhur' => '182.25 sq.ft = 16.93 m²',
                            '1 Bigha' => '≈ 13.31 Ropani',
                        ] as $unit => $value)
                            <div class="py-2.5">
                                <dt class="font-semibold text-slate-900">{{ $unit }}</dt>
                                <dd class="text-slate-600">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                    <p class="mt-4 text-xs text-slate-500">Values are for general reference. For legal measurements, refer to your Lalpurja and an official survey.</p>
                    <a href="{{ route('services.show', 'survey-lab-testing') }}" class="btn btn-primary mt-5 w-full">Need a land survey?</a>
                </div>
            </aside>
        </div>
    </section>
</x-layouts.app>
