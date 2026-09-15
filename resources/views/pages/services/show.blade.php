@php
    $title = $service['title'];
    $description = $service['lead'];
    $breadcrumbs = [
        ['label' => 'Accueil',         'url' => route('home')],
        ['label' => 'Nos prestations', 'url' => route('services.index')],
        ['label' => $service['title']],
    ];
@endphp

<x-layouts.app :title="$title" :description="$description">

    <x-breadcrumb-jsonld :items="$breadcrumbs" />

    @push('head')
    <style>
        .process-rail{position:relative;list-style:none;margin:0;padding:0}
        .process-rail::before{content:'';position:absolute;top:1.25rem;bottom:1.25rem;left:1.25rem;width:2px;background:#2F65AF}
        .process-rail__item{display:grid;grid-template-columns:2.5rem minmax(0,1fr);column-gap:1rem;align-items:center;padding-block:.85rem}
        .process-rail__node{grid-column:1;grid-row:1;position:relative;z-index:1;display:grid;place-items:center;width:2.5rem;height:2.5rem;border-radius:9999px;background:#2F65AF;color:#fff;font-family:Melior,"Source Serif 4",Georgia,serif;font-size:1.05rem;line-height:1}
        .process-rail__card{grid-column:2;grid-row:1;position:relative;padding:1.15rem 1.35rem;background:#FBF8F3;border:1px solid #E4E7EC;border-radius:12px}
        @media(min-width:640px){
            .process-rail::before{left:50%;transform:translateX(-50%)}
            .process-rail__item{grid-template-columns:minmax(0,1fr) 2.5rem minmax(0,1fr);column-gap:0}
            .process-rail__node{grid-column:2}
            .process-rail__item.is-right .process-rail__card{grid-column:3;margin-inline-start:1.35rem}
            .process-rail__item.is-left .process-rail__card{grid-column:1;margin-inline-end:1.35rem}
            .process-rail__card::before{content:'';position:absolute;top:50%;width:1.35rem;height:2px;background:#2F65AF}
            .process-rail__item.is-right .process-rail__card::before{left:-1.35rem}
            .process-rail__item.is-left .process-rail__card::before{right:-1.35rem}
        }
    </style>
    <script type="application/ld+json">
    {!! json_encode([
        '@'.'context'    => 'https://schema.org',
        '@type'       => 'Service',
        'name'        => $service['title'],
        'description' => $service['lead'],
        'serviceType' => $service['title'],
        'provider'    => [
            '@type' => 'ProfessionalService',
            'name'  => $company['name'],
            'url'   => url('/'),
        ],
        'areaServed'  => ['@type' => 'Country', 'name' => 'France'],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
    @endpush

    <x-hero
        variant="compact"
        eyebrow="Prestation"
        :title="$service['title']"
        :lead="$service['lead']"
        image="{{ asset('assets/images/pages/services-hero.jpg') }}"
        :breadcrumbs="$breadcrumbs"
    />

    <section class="section bg-white">
        <div class="container mx-auto grid lg:grid-cols-12 gap-12">

            <aside class="lg:col-span-4 lg:sticky lg:top-28 self-start">
                <div class="rounded-2xl border border-ink-100 p-8 bg-paper-50">
                    <x-service-icon :name="$service['icon']" class="w-10 h-10 text-brand-500" />
                    <h2 class="mt-6 text-2xl font-display text-ink-900 tracking-tight">En bref</h2>
                    <p class="mt-3 text-ink-500 leading-relaxed">{{ $service['summary'] }}</p>

                    <hr class="my-8">

                    <p class="rule-label">Bénéfices clés</p>
                    <ul class="mt-4 space-y-3">
                        @foreach ($service['benefits'] as $b)
                            <li class="flex items-start gap-3 text-ink-700 leading-relaxed">
                                <svg aria-hidden="true" class="w-5 h-5 mt-0.5 text-brand-500 shrink-0" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 10l4 4 8-9" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span>{{ $b }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('contact.show') }}" class="btn-primary w-full mt-10">Demander un devis</a>
                </div>
            </aside>

            <div class="lg:col-span-8">
                <p class="eyebrow">Notre intervention</p>
                <h2 class="mt-4 text-display-lg text-ink-900 tracking-tight">Ce que nous livrons.</h2>
                <p class="mt-6 text-lg text-ink-500 leading-relaxed max-w-2xl">
                    Notre équipe conçoit un dispositif sur mesure, calibré à votre organisation et à votre cahier
                    des charges. Voici les livrables typiques pour cette prestation.
                </p>

                <ol class="mt-12 space-y-6">
                    @foreach ($service['deliverables'] as $i => $d)
                        <li class="flex gap-6">
                            <span class="text-5xl font-display text-brand-500/20 tabular-nums leading-none">
                                {{ str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <p class="text-lg text-ink-700 leading-relaxed pt-1">{{ $d }}</p>
                        </li>
                    @endforeach
                </ol>

                <div class="mt-16">
                    <p class="eyebrow">Notre processus</p>
                    <h3 class="mt-4 text-2xl font-display text-ink-900 tracking-tight">Quatre étapes, un même standard d’exigence.</h3>

                    <ol class="process-rail mt-10" aria-label="Les quatre étapes du processus">
                        @foreach (\App\Data\SiteData::serviceProcess() as $i => [$t, $d])
                            <li @class(['process-rail__item', 'is-right' => $i % 2 === 0, 'is-left' => $i % 2 === 1])>
                                <span class="process-rail__node" aria-hidden="true">{{ $i + 1 }}</span>
                                <article class="process-rail__card">
                                    <span class="rule-label">Étape {{ $i + 1 }}</span>
                                    <h4 class="mt-2 font-display text-lg text-ink-900 tracking-tight">{{ $t }}</h4>
                                    <p class="mt-1 text-sm text-ink-500 leading-relaxed">{{ $d }}</p>
                                </article>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </section>

    @if (count($related))
        <section class="section bg-paper-50">
            <div class="container mx-auto">
                <x-section-title
                    eyebrow="À découvrir aussi"
                    title="Prestations liées."
                />
                <ul class="mt-12 grid gap-6 md:grid-cols-2">
                    @foreach ($related as $i => $r)
                        <li><x-service-card :service="$r" :index="$i" :total="count($related)" /></li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <x-cta-band
        kicker="Une question sur cette prestation ?"
        title="Écrivons ensemble votre dispositif sur mesure."
    />
</x-layouts.app>
