@php
    $title = 'À propos';
    $description = 'BSM-Services accompagne de manière opérationnelle les PME et start-ups dans leur développement. Découvrez notre modèle, nos valeurs et notre dirigeant.';
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('home')],
        ['label' => 'À propos'],
    ];
@endphp

<x-layouts.app :title="$title" :description="$description">

    <x-breadcrumb-jsonld :items="$breadcrumbs" />

    <x-hero
        variant="compact"
        eyebrow="Qui nous sommes"
        title="Vous êtes à la tête d’une PME ? Mettez vos ressources en phase avec vos besoins, en toute flexibilité."
        lead="« Nous proposons à nos clients, PME et start-ups qui interviennent dans les prestations de services, de leur mettre des profils cadres à disposition. »"
        image="{{ asset('assets/images/pages/about-hero.jpg') }}"
        imageAlt="Bureaux de BSM-Services à Antananarivo"
        :breadcrumbs="$breadcrumbs"
    />

    <section class="section bg-white">
        <div class="container mx-auto grid lg:grid-cols-12 gap-12">
            <div class="lg:col-span-5">
                <p class="eyebrow">Notre promesse</p>
                <h2 class="mt-4 text-display-lg text-ink-900 tracking-tight">
                    Vous êtes à la tête d’une PME ? Mettez vos ressources en phase avec vos besoins, en toute flexibilité.
                </h2>
            </div>
            <div class="lg:col-span-6 lg:col-start-7 space-y-6 text-lg text-ink-500 leading-relaxed">
                <p>Parce que vous redoutez d’entreprendre dans un environnement légal rigide, et parce que notre modèle repose sur l’agilité et la flexibilité, nous accompagnons — en spécialistes de l’externalisation auprès des start-ups et des PME — nos clients dans leur développement opérationnel et stratégique.</p>
                <p>Nous répondons de manière spécialisée à vos besoins et recrutons des profils identiques à ceux que vous recrutez en interne.</p>
            </div>
        </div>
    </section>

    <section class="section bg-paper-50" aria-labelledby="values-heading">
        <div class="container mx-auto">
            <x-section-title
                eyebrow="Les avantages pour vous"
                title="Quatre engagements, jamais négociables."
                lead="Chaque mission suit la même exigence, quels que soient sa taille et son domaine."
            />

            <div class="mt-14 grid gap-6 md:grid-cols-2">
                @foreach ($values as $i => $value)
                    <article @class([
                        'p-10 rounded-2xl border',
                        'bg-white border-ink-100' => $i % 2 === 0,
                        'bg-ink-900 text-white border-ink-900' => $i % 2 === 1,
                    ])>
                        <div class="flex items-center gap-4">
                            <span @class([
                                'grid place-items-center w-12 h-12 rounded-full font-display text-lg',
                                'bg-brand-500 text-white' => $i % 2 === 0,
                                'bg-white text-ink-900'   => $i % 2 === 1,
                            ])>0{{ $i + 1 }}</span>
                            <h3 @class([
                                'text-2xl font-display tracking-tight',
                                'text-ink-900' => $i % 2 === 0,
                                'text-white'   => $i % 2 === 1,
                            ])>{{ $value['title'] }}</h3>
                        </div>
                        <p @class([
                            'mt-6 leading-relaxed',
                            'text-ink-500' => $i % 2 === 0,
                            'text-white/80' => $i % 2 === 1,
                        ])>{{ $value['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section bg-white">
        <div class="container mx-auto grid lg:grid-cols-12 gap-12 items-start">
            <figure class="lg:col-span-5">
                <div class="relative aspect-[4/5] rounded-2xl overflow-hidden shadow-lift bg-paper-100">
                    <img src="{{ $director['photo'] }}"
                         alt="Portrait de {{ $director['name'] }}"
                         width="720" height="900" loading="lazy" decoding="async"
                         class="h-full w-full object-cover">
                </div>
                <figcaption class="mt-6">
                    <p class="font-display text-ink-900">{{ $director['name'] }}</p>
                    <p class="text-ink-500 text-sm">{{ $director['role'] }}</p>
                </figcaption>
            </figure>

            <div class="lg:col-span-7">
                <p class="eyebrow">Mot du dirigeant</p>
                <blockquote class="mt-4 text-display-lg text-ink-900 leading-tight tracking-tight">
                    « {{ $director['quote'] }} »
                </blockquote>
                <div class="mt-8 space-y-5 text-lg text-ink-500 leading-relaxed max-w-2xl">
                    @foreach ($director['paragraphs'] as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section-tight bg-paper-100 border-y border-ink-100">
        <div class="container mx-auto grid lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8">
                <p class="eyebrow">Externalisez</p>
                <p class="mt-4 text-2xl md:text-3xl font-display text-ink-900 tracking-tight leading-snug">
                    À vous la stratégie et le cœur de métier, à nous les hommes et leur gestion administrative.
                </p>
                <p class="mt-3 text-ink-500">Cette alliance au profit de votre développement.</p>
            </div>
            <div class="lg:col-span-4 lg:text-right">
                <a href="{{ route('services.index') }}" class="btn-primary">Nos prestations</a>
            </div>
        </div>
    </section>

    <x-cta-band
        kicker="On se rencontre ?"
        title="Passons de la conversation au projet."
    />
</x-layouts.app>
