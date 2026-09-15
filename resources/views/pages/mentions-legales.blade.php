@php
    $title = 'Mentions légales';
    $description = 'Mentions légales et informations éditoriales du site BSM-Services.';
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('home')],
        ['label' => 'Mentions légales'],
    ];
@endphp

<x-layouts.app :title="$title" :description="$description">

    <x-breadcrumb-jsonld :items="$breadcrumbs" />

    <x-hero
        variant="compact"
        eyebrow="Informations légales"
        title="Mentions légales."
        :breadcrumbs="$breadcrumbs"
    />

    <section class="section bg-white">
        <div class="container mx-auto max-w-3xl prose prose-lg prose-editorial">
            <p>Bienvenue sur le site de <strong>{{ $company['name'] }}</strong>.</p>
            <p>En accédant à ce site, vous acceptez, sans limitation ni réserve, les dispositions légales en vigueur et les conditions ci-après détaillées.</p>

            <h2>Éditeur</h2>
            <p>
                Le site <code>www.bsm-services.com</code> est la propriété de&nbsp;:<br>
                <strong>{{ $company['legal_name'] }}</strong><br>
                {{ $company['address']['street'] }}<br>
                {{ $company['address']['zip'] }} {{ $company['address']['city'] }}, {{ $company['address']['country'] }}
            </p>
            <p>
                Immatriculée au {{ $company['rcs'] }}, au capital de {{ $company['capital'] }}.<br>
                Téléphone&nbsp;: {{ $company['phone_fr'] }} / {{ $company['phone_mg'] }}<br>
                E-mail&nbsp;: <a href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a>
            </p>

            <h2>Hébergement</h2>
            <p>Site hébergé par OVH – 2 rue Kellermann, 59100 Roubaix, France.</p>

            <h2>1. Informations figurant sur le site</h2>
            <p>Le propriétaire du site fournit des informations à des fins purement informatives. Il s’efforce de contrôler leur exactitude et de les maintenir à jour, mais aucune garantie n’est apportée concernant l’exactitude, la précision, la mise à jour ou l’exhaustivité de ces informations.</p>
            <p>Par conséquent, et à l’exception d’une faute lourde et intentionnelle, le propriétaire du site décline toute responsabilité pour tout dommage résultant notamment d’une imprécision ou inexactitude des informations disponibles sur ce site.</p>

            <h2>2. Cookies</h2>
            <p>Ce site utilise des cookies techniques strictement nécessaires à son bon fonctionnement. En aucun cas ils ne servent à collecter des données personnelles sans votre accord exprès.</p>

            <h2>3. Propriété intellectuelle</h2>
            <p>L’ensemble des éléments édités sur ce site (textes, photographies, logos, marques…) constituent des œuvres de l’esprit au sens du Code de la Propriété Intellectuelle. Toute utilisation sans le consentement de leurs auteurs ou ayants-droit est illicite.</p>

            <h2>4. Droit applicable</h2>
            <p>Le site et son contenu sont créés conformément aux droits et règles applicables à Madagascar.</p>
        </div>
    </section>

    <x-cta-band kicker="Une question ?" title="Notre équipe est à votre disposition." />
</x-layouts.app>
