@props([
    'kicker'  => 'Prêt à commencer ?',
    'title'   => 'Discutons de votre projet.',
    'lead'    => 'Faites-nous part de vos enjeux : nous vous rappelons sous 24h ouvrées.',
    'primary' => ['label' => 'Nous contacter', 'href' => null],
    'secondary' => null,
])

@php $primary['href'] = $primary['href'] ?? route('contact.show'); @endphp

<section class="section bg-ink-900 text-white relative overflow-hidden">
    <div aria-hidden="true" class="absolute inset-y-0 right-0 w-2/3 stripe-brand opacity-20"></div>

    <div class="relative container mx-auto grid lg:grid-cols-12 gap-10 items-end">
        <div class="lg:col-span-8">
            <p class="eyebrow text-brand-400">{{ $kicker }}</p>
            <h2 class="mt-6 text-display-xl text-white tracking-tight">{{ $title }}</h2>
            @if ($lead)
                <p class="mt-6 text-lg text-white/70 leading-relaxed max-w-2xl">{{ $lead }}</p>
            @endif
        </div>
        <div class="lg:col-span-4 flex flex-wrap gap-3 lg:justify-end">
            <a href="{{ $primary['href'] }}" class="btn bg-brand-500 text-white shadow-brand hover:bg-brand-600 hover:-translate-y-0.5">
                {{ $primary['label'] }}
            </a>
            @if ($secondary)
                <a href="{{ $secondary['href'] }}" class="btn border border-white/20 text-white hover:bg-white/5">
                    {{ $secondary['label'] }}
                </a>
            @endif
        </div>
    </div>
</section>
