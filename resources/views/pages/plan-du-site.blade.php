@php
    use App\Data\SiteData;

    $title = 'Plan du site';
    $description = 'Toutes les pages du site BSM-Services, organisées par section.';
    $breadcrumbs = [
        ['label' => 'Accueil', 'url' => route('home')],
        ['label' => 'Plan du site'],
    ];
@endphp

<x-layouts.app :title="$title" :description="$description">

    <x-breadcrumb-jsonld :items="$breadcrumbs" />

    <x-hero
        variant="compact"
        eyebrow="Navigation"
        title="Plan du site."
        lead="Une vue d’ensemble pour retrouver rapidement chaque page."
        :breadcrumbs="$breadcrumbs"
    />

    <section class="section bg-white">
        <div class="container mx-auto grid md:grid-cols-3 gap-12">

            <div>
                <p class="eyebrow">L’entreprise</p>
                <ul class="mt-6 space-y-3 text-lg">
                    <li><a class="text-ink-800 hover:text-brand-600 transition" href="{{ route('home') }}">Accueil</a></li>
                    <li><a class="text-ink-800 hover:text-brand-600 transition" href="{{ route('about') }}">À propos</a></li>
                    <li><a class="text-ink-800 hover:text-brand-600 transition" href="{{ route('contact.show') }}">Contact</a></li>
                </ul>
            </div>

            <div>
                <p class="eyebrow">Prestations</p>
                <ul class="mt-6 space-y-3 text-lg">
                    <li><a class="text-ink-800 hover:text-brand-600 transition" href="{{ route('services.index') }}">Toutes nos prestations</a></li>
                    @foreach (SiteData::services() as $s)
                        <li><a class="text-ink-500 hover:text-brand-600 transition" href="{{ route('services.show', $s['slug']) }}">— {{ $s['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <p class="eyebrow">Recrutement</p>
                <ul class="mt-6 space-y-3 text-lg">
                    <li><a class="text-ink-800 hover:text-brand-600 transition" href="{{ route('recrutement') }}">Recrutement</a></li>
                    <li><a class="text-ink-500 hover:text-brand-600 transition" href="{{ route('recrutement') }}#offres">— Nos offres d’emploi</a></li>
                    <li><a class="text-ink-500 hover:text-brand-600 transition" href="{{ route('recrutement') }}#processus">— Notre processus de recrutement</a></li>
                    <li><a class="text-ink-500 hover:text-brand-600 transition" href="{{ route('recrutement') }}#faq">— FAQ Recrutement</a></li>
                    <li><a class="text-ink-500 hover:text-brand-600 transition" href="{{ route('contact.show', ['motif' => 'candidature']) }}">— Envoyer une candidature</a></li>
                    <li><a class="text-ink-500 hover:text-brand-600 transition" href="{{ route('services.show', 'externalisation-rh') }}">— Externalisation RH</a></li>
                </ul>

                <p class="eyebrow mt-10">Légal</p>
                <ul class="mt-6 space-y-3 text-lg">
                    <li><a class="text-ink-800 hover:text-brand-600 transition" href="{{ route('legal.mentions') }}">Mentions légales</a></li>
                </ul>
            </div>
        </div>
    </section>
</x-layouts.app>
