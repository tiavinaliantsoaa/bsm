@php
    $title = null;
    $description = 'BSM-Services met à disposition des profils cadres Bac+4/5 pour PME et start-ups. Externalisation, commercial, veille, web marketing, RH, études — depuis Antananarivo.';
@endphp

<x-layouts.app :title="$title" :description="$description">

    <x-hero
        eyebrow="Externalisation cadres · PME & Start-ups"
        title="Nous nous identifions nous-mêmes comme une start-up."
        lead="Partenaires de votre développement, nous partageons certains points communs avec vous : flexibilité, agilité, mindset. Nous étudions chaque demande de manière spécifique et trouvons les ressources qui lui correspondent — sans jamais transiger sur la qualité que vous êtes en droit d’exiger."
        image="{{ asset('assets/images/pages/home-hero-illustration.png') }}"
        imageAlt="Illustration : deux collaboratrices construisent ensemble un plan d’action"
        imageMode="illustration"
    >
        <x-slot:actions>
            <a href="{{ route('services.index') }}" class="btn-primary">Voir nos prestations</a>
            <a href="{{ route('contact.show') }}"   class="btn-ghost">Discutons de votre projet</a>
        </x-slot:actions>
    </x-hero>

    <section class="pt-8 pb-16 bg-white">
        <div class="container mx-auto grid lg:grid-cols-12 gap-10 items-start">
            <div class="lg:col-span-4">
                <p class="eyebrow">Notre positionnement</p>
                <h2 class="mt-4 text-display-lg text-ink-900 tracking-tight">
                    Nous nous identifions nous-mêmes comme une start-up.
                </h2>
            </div>
            <div class="lg:col-span-7 lg:col-start-6 space-y-6 text-lg text-ink-500 leading-relaxed">
                <p>
                    « Nous proposons à nos clients, PME et start-ups qui interviennent dans les prestations de services, de leur mettre des profils cadres à disposition. »
                </p>
                <p>
                    Partenaires de votre développement, nous partageons certains points communs avec vous&nbsp;:
                    <strong class="text-ink-800">flexibilité</strong>,
                    <strong class="text-ink-800">agilité</strong>,
                    <strong class="text-ink-800">mindset</strong>.
                </p>
            </div>
        </div>
    </section>

    <section class="pt-8 pb-20 bg-paper-50" aria-labelledby="services-heading">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-14">
                <x-section-title
                    eyebrow="Vos problématiques"
                    title="Faites-nous part de vos projets."
                    lead="Nous réfléchissons ensemble aux plans d’action appropriés pour satisfaire vos besoins, quel qu’en soit le niveau de complexité."
                />
                <a href="{{ route('services.index') }}" class="btn-ghost self-start lg:self-end shrink-0">
                    Toutes nos prestations
                </a>
            </div>

            <div class="mb-10 grid gap-4 md:grid-cols-2 text-sm text-ink-500 leading-relaxed">
                <p>Métiers d’appui aux entreprises sur les volets suivants : administratif, commercial, finances et comptabilité, web marketing et community management, assistanat, …</p>
                <p>Métiers techniques : graphiste, développement web, administration système et réseaux.</p>
            </div>

            <ul class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $i => $service)
                    <li>
                        <x-service-card :service="$service" :index="$i" :total="count($services)" />
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="section bg-white" aria-labelledby="why-heading">
        <div class="container mx-auto grid lg:grid-cols-12 gap-12">

            <div class="lg:col-span-4">
                <p class="eyebrow">Les avantages pour vous</p>
                <h2 id="why-heading" class="mt-4 text-display-lg text-ink-900 tracking-tight">
                    Quatre engagements, jamais négociables.
                </h2>
                <p class="mt-6 text-ink-500 leading-relaxed">
                    Chaque mission suit la même exigence, quels que soient sa taille et son domaine.
                </p>
                <a href="{{ route('about') }}" class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-brand-600 hover:text-brand-700">
                    Découvrir notre approche
                    <svg aria-hidden="true" class="w-4 h-4" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 10h12M12 5l5 5-5 5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>

            <div class="lg:col-span-8 grid sm:grid-cols-2 gap-4">
                @foreach ($values as $i => $value)
                    <div @class([
                        'p-8 rounded-2xl',
                        'bg-ink-900 text-white'    => $i === 0,
                        'bg-brand-500 text-white'  => $i === 3,
                        'bg-paper-50 border border-ink-100' => in_array($i, [1, 2]),
                        'sm:translate-y-8' => $i % 2,
                    ])>
                        <p @class([
                            'text-eyebrow',
                            'text-white/70'   => in_array($i, [0, 3]),
                            'text-brand-600'  => !in_array($i, [0, 3]),
                        ])>0{{ $i + 1 }}</p>
                        <h3 @class([
                            'mt-4 text-2xl font-display tracking-tight',
                            'text-white'    => in_array($i, [0, 3]),
                            'text-ink-900'  => !in_array($i, [0, 3]),
                        ])>{{ $value['title'] }}</h3>
                        <p @class([
                            'mt-3 leading-relaxed',
                            'text-white/80' => in_array($i, [0, 3]),
                            'text-ink-500'  => !in_array($i, [0, 3]),
                        ])>{{ $value['body'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section bg-navy-800 text-white overflow-hidden">
        <div class="container mx-auto grid lg:grid-cols-12 gap-12 items-center">
            <figure class="lg:col-span-5">
                <div class="relative aspect-[4/5] rounded-2xl overflow-hidden shadow-lift bg-navy-900">
                    <img src="{{ $director['photo'] }}"
                         alt="{{ $director['name'] }}, {{ $director['role'] }}"
                         width="720" height="900" loading="lazy" decoding="async"
                         class="h-full w-full object-cover">
                </div>
                <figcaption class="mt-6">
                    <p class="font-display text-white">{{ $director['name'] }}</p>
                    <p class="text-white/60 text-sm">{{ $director['role'] }} · BSM-Services</p>
                </figcaption>
            </figure>

            <div class="lg:col-span-7">
                <p class="eyebrow text-brand-400">Message du dirigeant</p>
                <blockquote class="mt-6">
                    <p class="text-display-lg text-white leading-tight tracking-tight">
                        « {{ $director['quote'] }} »
                    </p>
                </blockquote>
                <div class="mt-8 space-y-5 text-white/80 leading-relaxed text-lg max-w-2xl">
                    @foreach ($director['paragraphs'] as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section-tight bg-paper-100 border-y border-ink-100">
        <div class="container mx-auto grid grid-cols-2 lg:grid-cols-4 gap-y-10 gap-x-6">
            @foreach ($facts as $fact)
                <div class="border-l border-ink-200 pl-5">
                    <p class="text-4xl md:text-5xl font-display text-ink-900 tracking-tight">{{ $fact['value'] }}</p>
                    <p class="mt-2 text-sm text-ink-500">{{ $fact['label'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section bg-white" aria-label="Recrutement">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8 mb-14">
                <x-section-title
                    eyebrow="Recrutement"
                    title="Des profils cadres, recrutés pour votre projet."
                    lead="Chaque collaborateur est recruté et affecté à un projet client identifié avant même son recrutement."
                />
                <a href="{{ route('recrutement') }}" class="btn-ghost self-start lg:self-end shrink-0">
                    Voir le recrutement
                </a>
            </div>

            <ol class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($recruitment['steps'] as $i => $step)
                    <li class="p-8 rounded-2xl bg-paper-50 border border-ink-100 flex flex-col h-full">
                        <p class="text-eyebrow text-brand-600">0{{ $i + 1 }}</p>
                        <h3 class="mt-4 text-xl font-display text-ink-900 tracking-tight">{{ $step['title'] }}</h3>
                        <p class="mt-3 text-ink-500 leading-relaxed">{{ $step['body'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <x-cta-band
        kicker="Passons à l’action"
        title="À vous la stratégie et le cœur de métier, à nous les hommes et leur gestion administrative."
        lead="Cette alliance au profit de votre développement."
        :primary="['label' => 'Nous contacter', 'href' => route('contact.show')]"
        :secondary="['label' => 'Voir nos prestations', 'href' => route('services.index')]"
    />
</x-layouts.app>
