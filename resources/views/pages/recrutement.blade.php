@php
    $title = 'Recrutement';
    $description = 'BSM-Services recrute des profils cadres Bac+4/5 à Antananarivo, dédiés à un projet client. Consultez nos offres d’emploi, le processus de recrutement et la FAQ.';
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('home')],
        ['label' => 'Recrutement'],
    ];
    $openJobs = array_values(array_filter(
        $recruitment['jobs'] ?? [],
        fn (array $job): bool => $job['open'] ?? true
    ));
    $applySpontaneous = route('contact.show', ['motif' => 'candidature']);
@endphp

<x-layouts.app :title="$title" :description="$description">

    <x-breadcrumb-jsonld :items="$breadcrumbs" />

    @push('head')
    <style>
        #offres, #processus, #faq { scroll-margin-top: 7rem; }
        .disclosure > summary { list-style: none; cursor: pointer; }
        .disclosure > summary::-webkit-details-marker,
        .disclosure > summary::marker { display: none; content: none; }
        .disclosure[open] > summary .disclosure-icon { transform: rotate(45deg); }
    </style>
    <script type="application/ld+json">
    {!! json_encode([
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => array_map(fn (array $item) => [
            '@type'          => 'Question',
            'name'           => $item['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $item['a'],
            ],
        ], $recruitment['faq']),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
    @endpush

    <x-hero
        variant="compact"
        eyebrow="Recrutement"
        title="Nous recrutons des profils cadres identiques à ceux que vous recrutez en interne."
        lead="Chaque collaborateur est recruté et affecté à un projet client identifié avant même son recrutement. Nos équipes vous sont exclusivement dédiées."
        image="{{ asset('assets/images/pages/about-hero.jpg') }}"
        imageAlt="Équipes BSM-Services à Antananarivo"
        :breadcrumbs="$breadcrumbs"
    />

    <nav class="bg-white border-b border-ink-100" aria-label="Sections recrutement">
        <div class="container mx-auto py-4">
            <ul class="flex flex-wrap gap-8 text-sm">
                <li><a href="#offres" class="text-ink-600 hover:text-brand-600 transition">Nos offres d’emploi</a></li>
                <li><a href="#processus" class="text-ink-600 hover:text-brand-600 transition">Notre processus de recrutement</a></li>
                <li><a href="#faq" class="text-ink-600 hover:text-brand-600 transition">FAQ Recrutement</a></li>
            </ul>
        </div>
    </nav>

    <section class="section bg-white">
        <div class="container mx-auto grid lg:grid-cols-12 gap-12">
            <div class="lg:col-span-5">
                <p class="eyebrow">Notre exigence</p>
                <h2 class="mt-4 text-display-lg text-ink-900 tracking-tight">
                    Des jeunes diplômés Bac+4/5, formés à nos côtés.
                </h2>
            </div>
            <div class="lg:col-span-6 lg:col-start-7 space-y-6 text-lg text-ink-500 leading-relaxed">
                <p>Nous recrutons des profils sortants des meilleures écoles et de l’Université d’Antananarivo, et les faisons grandir à nos côtés.</p>
                <p>Nous proposons des profils similaires à ceux que nos clients auraient recrutés en France, et restons très exigeants dans notre processus de sélection.</p>
                <p>Ce modèle nous permet d’assurer un faible turnover, dans une start-up qui fait grandir ses talents.</p>
            </div>
        </div>
    </section>

    <section id="offres" class="section bg-paper-50" aria-label="Nos offres d’emploi">
        <div class="container mx-auto">
            <x-section-title
                eyebrow="Carrière"
                title="Nos offres d’emploi."
                lead="Découvrez les missions actuellement ouvertes à Antananarivo. Chaque offre correspond à l’une de nos familles de prestations."
            />

            @if (count($openJobs))
                <ul class="mt-14 grid gap-6 md:grid-cols-2">
                    @foreach ($openJobs as $job)
                        <li>
                            <article class="h-full flex flex-col p-8 md:p-10 rounded-2xl bg-white border border-ink-100">
                                <div class="flex items-start justify-between gap-4">
                                    <p class="eyebrow">{{ $job['pole'] }}</p>
                                    <span class="rule-label">{{ $job['contract'] }}</span>
                                </div>
                                <h3 class="mt-4 text-2xl font-display text-ink-900 tracking-tight">{{ $job['title'] }}</h3>
                                <p class="mt-2 text-sm text-ink-400">{{ $job['location'] }} · {{ $job['schedule'] }}</p>
                                <p class="mt-4 text-ink-500 leading-relaxed">{{ $job['lead'] }}</p>

                                <details class="disclosure mt-6">
                                    <summary class="inline-flex items-center gap-2 text-sm font-semibold text-ink-800 hover:text-brand-600 transition">
                                        L’offre en détail
                                        <svg class="disclosure-icon w-4 h-4 transition duration-300" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path d="M10 4v12M4 10h12" stroke-linecap="round"/>
                                        </svg>
                                    </summary>
                                    <div class="mt-5 space-y-5">
                                        <div>
                                            <p class="rule-label">Missions</p>
                                            <ul class="mt-3 space-y-2 text-ink-500 leading-relaxed">
                                                @foreach ($job['missions'] as $mission)
                                                    <li class="flex gap-3">
                                                        <span aria-hidden="true" class="mt-2 h-1.5 w-1.5 rounded-full bg-brand-500 shrink-0"></span>
                                                        <span>{{ $mission }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div>
                                            <p class="rule-label">Profil recherché</p>
                                            <ul class="mt-3 space-y-2 text-ink-500 leading-relaxed">
                                                @foreach ($job['profile'] as $line)
                                                    <li class="flex gap-3">
                                                        <span aria-hidden="true" class="mt-2 h-1.5 w-1.5 rounded-full bg-brand-500 shrink-0"></span>
                                                        <span>{{ $line }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </details>

                                <div class="mt-auto pt-8">
                                    <a href="{{ route('contact.show', ['motif' => 'candidature', 'poste' => $job['slug']]) }}"
                                       class="btn-primary">
                                        Postuler
                                    </a>
                                </div>
                            </article>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="mt-14 p-10 rounded-2xl bg-white border border-ink-100 text-center">
                    <p class="text-2xl font-display text-ink-900 tracking-tight">Aucune offre n’est ouverte pour le moment.</p>
                    <p class="mt-3 text-ink-500 leading-relaxed max-w-xl mx-auto">
                        Envoyez-nous une candidature spontanée : nous l’étudions au regard des missions en cours et à venir.
                    </p>
                    <a href="{{ $applySpontaneous }}" class="btn-primary mt-8">Candidature spontanée</a>
                </div>
            @endif

            @if (count($openJobs))
                <div class="mt-8 p-8 md:p-10 rounded-2xl bg-ink-900 text-white grid lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-8">
                        <p class="eyebrow text-brand-400">Candidature spontanée</p>
                        <h3 class="mt-3 text-2xl font-display tracking-tight">Aucune offre ne correspond à votre profil&nbsp;?</h3>
                        <p class="mt-3 text-white/75 leading-relaxed">
                            Envoyez-nous votre candidature spontanée : nous l’étudierons au regard de nos missions en cours et à venir.
                        </p>
                    </div>
                    <div class="lg:col-span-4 lg:text-right">
                        <a href="{{ $applySpontaneous }}" class="btn bg-brand-500 text-white shadow-brand hover:bg-brand-600">
                            Candidature spontanée
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section id="processus" class="section bg-white" aria-label="Notre processus de recrutement">
        <div class="container mx-auto">
            <x-section-title
                eyebrow="Le déroulé"
                title="Notre processus de recrutement."
                lead="Quatre étapes, de la candidature à l’affectation : la même exigence, quel que soit le domaine."
            />

            <ol class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($recruitment['process'] as $i => $step)
                    <li class="relative p-8 rounded-2xl bg-paper-50 border border-ink-100 flex flex-col h-full">
                        <p class="text-eyebrow text-brand-600">0{{ $i + 1 }}</p>
                        <h3 class="mt-4 text-xl font-display text-ink-900 tracking-tight">{{ $step['title'] }}</h3>
                        <p class="mt-3 text-ink-500 leading-relaxed">{{ $step['body'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section id="faq" class="section bg-paper-50" aria-label="FAQ Recrutement">
        <div class="container mx-auto grid lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-4 lg:sticky lg:top-28">
                <x-section-title
                    eyebrow="Questions fréquentes"
                    title="FAQ Recrutement."
                    lead="Les réponses aux questions que se posent le plus souvent nos candidats."
                />
            </div>

            <div class="lg:col-span-8">
                <div class="rounded-2xl bg-white border border-ink-100">
                    @foreach ($recruitment['faq'] as $item)
                        <details @class(['disclosure group px-6', 'border-t border-ink-100' => ! $loop->first])>
                            <summary class="flex items-center justify-between gap-4 py-6 text-lg font-display text-ink-900 tracking-tight hover:text-brand-600 transition">
                                <span>{{ $item['q'] }}</span>
                                <span class="disclosure-icon grid place-items-center w-10 h-10 rounded-full border border-ink-100 text-brand-600 shrink-0 transition duration-300" aria-hidden="true">
                                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M10 4v12M4 10h12" stroke-linecap="round"/>
                                    </svg>
                                </span>
                            </summary>
                            <p class="pb-6 text-ink-500 leading-relaxed max-w-2xl">{{ $item['a'] }}</p>
                        </details>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section bg-white">
        <div class="container mx-auto grid lg:grid-cols-12 gap-10">

            <article class="lg:col-span-6 p-10 rounded-2xl bg-ink-900 text-white">
                <p class="eyebrow text-brand-400">Vous recrutez</p>
                <h2 class="mt-4 text-display-lg text-white tracking-tight">Pour les dirigeants de PME et de start-ups.</h2>
                <p class="mt-6 text-white/75 leading-relaxed">
                    À vous la stratégie et le cœur de métier, à nous les hommes et leur gestion administrative.
                    Nous nous efforçons de recruter des profils similaires à ceux que chaque client aurait recrutés en France.
                </p>
                <a href="{{ route('contact.show') }}" class="btn bg-brand-500 text-white shadow-brand hover:bg-brand-600 mt-8">
                    Parler d’un besoin
                </a>
            </article>

            <article class="lg:col-span-6 p-10 rounded-2xl bg-paper-50 border border-ink-100">
                <p class="eyebrow">Vous candidatez</p>
                <h2 class="mt-4 text-display-lg text-ink-900 tracking-tight">Rejoindre BSM-Services à Antananarivo.</h2>
                <p class="mt-6 text-ink-500 leading-relaxed">
                    Nous faisons grandir des profils Bac+4/5 aux côtés de nos clients français — commercial, veille, marketing, RH, études.
                    Envoyez-nous votre candidature : nous l’étudions au regard des missions en cours et à venir.
                </p>
                <a href="{{ $applySpontaneous }}" class="btn-primary mt-8">
                    Envoyer une candidature
                </a>
            </article>
        </div>
    </section>

    <section class="section-tight bg-paper-100 border-y border-ink-100">
        <div class="container mx-auto grid lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8">
                <p class="eyebrow">Cabinets de recrutement</p>
                <h2 class="mt-4 text-2xl md:text-3xl font-display text-ink-900 tracking-tight leading-snug">
                    Externalisez une partie de votre chaîne de valeur.
                </h2>
                <ul class="mt-5 space-y-2 text-ink-500">
                    @foreach ($recruitment['rh_missions'] as $mission)
                        <li class="flex gap-3">
                            <span aria-hidden="true" class="mt-2 h-1.5 w-1.5 rounded-full bg-brand-500 shrink-0"></span>
                            <span>{{ $mission }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="lg:col-span-4 lg:text-right">
                <a href="{{ route('services.show', 'externalisation-rh') }}" class="btn-ghost">
                    Externalisation RH
                </a>
            </div>
        </div>
    </section>

    <x-cta-band
        kicker="Une candidature, un projet"
        title="Écrivez-nous : nous revenons vers vous."
        lead="Dirigeant en recherche de profils cadres, ou candidat Bac+4/5 à Antananarivo : un seul interlocuteur."
        :primary="['label' => 'Nous contacter', 'href' => route('contact.show')]"
        :secondary="['label' => 'Envoyer une candidature', 'href' => $applySpontaneous]"
    />
</x-layouts.app>
