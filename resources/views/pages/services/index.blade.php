@php
    $title = 'Nos prestations';
    $description = 'Découvrez les familles de prestations BSM-Services : commercial, veille, web marketing, externalisation RH, admin & finances, développement web et missions sur mesure.';
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('home')],
        ['label' => 'Nos prestations'],
    ];
@endphp

<x-layouts.app :title="$title" :description="$description">

    <x-breadcrumb-jsonld :items="$breadcrumbs" />

    <x-hero
        variant="compact"
        eyebrow="Notre offre"
        title="Plusieurs familles de prestations, pensées pour les PME et les start-ups."
        lead="Notre modèle, tourné vers l’intuitu personae, place l’humain au centre de l’organisation. Chaque collaborateur est affecté à un projet client identifié avant même son recrutement."
        image="{{ asset('assets/images/pages/services-hero.jpg') }}"
        imageAlt="Équipe BSM-Services en réunion"
        :breadcrumbs="$breadcrumbs"
    />

    <section class="section bg-white">
        <div class="container mx-auto grid lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-5">
                <p class="eyebrow">Notre méthode</p>
                <h2 class="mt-4 text-display-lg text-ink-900 tracking-tight">
                    Un modèle singulier, adressé aux dirigeants en quête de flexibilité et de qualité.
                </h2>
            </div>
            <div class="lg:col-span-6 lg:col-start-7 space-y-6 text-lg text-ink-500 leading-relaxed">
                <p>Nous recrutons des profils jeunes diplômés <strong class="text-ink-800">Bac+4/5</strong>, sortants des meilleures écoles de commerce et de l’Université d’Antananarivo, et les faisons grandir à nos côtés.</p>
                <p>Au-delà de 3 mois d’engagement, chaque client participe au processus de sélection des candidats qui lui seront attribués. Nous proposons des profils similaires à ceux qu’il aurait recrutés en France, et restons très exigeants dans notre processus de sélection.</p>
                <p>Ce modèle nous permet d’assurer un faible turnover, dans une start-up qui fait grandir ses talents.</p>
            </div>
        </div>
    </section>

    <section class="section bg-paper-50">
        <div class="container mx-auto">
            <x-section-title
                eyebrow="Nos prestations"
                title="Plusieurs manières de vous accompagner."
                lead="Chaque offre peut être combinée à une autre, à la carte, selon votre cahier des charges."
            />

            <ul class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($services as $i => $service)
                    <li>
                        <x-service-card :service="$service" :index="$i" :total="count($services)" />
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-cta-band
        kicker="Gagnez en compétitivité"
        title="« Intuitu personae, exigences et qualité sont nos principaux leitmotive. »"
        lead="Faites-nous part de votre projet : nous concevons ensemble le dispositif adapté."
    />
</x-layouts.app>
