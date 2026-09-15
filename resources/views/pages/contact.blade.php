@php
    use App\Data\SiteData;

    $isCandidature = request('motif') === 'candidature';
    $posteSlug = (string) request('poste', '');
    $posteTitle = null;
    if ($isCandidature && $posteSlug !== '') {
        foreach (SiteData::recruitment()['jobs'] as $job) {
            if (($job['slug'] ?? '') === $posteSlug) {
                $posteTitle = $job['title'];
                break;
            }
        }
    }
    $candidaturePrefill = $posteTitle
        ? 'Candidature — '.$posteTitle.' — je souhaite rejoindre BSM-Services à Antananarivo.'
        : 'Candidature — je souhaite rejoindre BSM-Services à Antananarivo.';
    $title = $isCandidature
        ? ($posteTitle ? 'Candidature — '.$posteTitle : 'Candidature')
        : 'Contact';
    $description = $isCandidature
        ? 'Envoyez votre candidature à BSM-Services à Antananarivo. Profils cadres Bac+4/5, missions dédiées à des PME et start-ups.'
        : 'Contactez BSM-Services à Antananarivo. Formulaire, téléphone, email et plan d’accès. Nous répondons sous 24h ouvrées.';
    $breadcrumbs = $isCandidature
        ? [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Recrutement', 'url' => route('recrutement')],
            ['label' => $posteTitle ?: 'Candidature'],
        ]
        : [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Contact'],
        ];
@endphp

<x-layouts.app :title="$title" :description="$description">

    <x-breadcrumb-jsonld :items="$breadcrumbs" />

    <x-hero
        variant="compact"
        :eyebrow="$isCandidature ? 'Recrutement' : 'Contact'"
        :title="$isCandidature ? 'Envoyez-nous votre candidature.' : 'Faites-nous part de vos enjeux.'"
        :lead="$isCandidature
            ? 'Profils cadres Bac+4/5, basés à Antananarivo, dédiés à un projet client. Décrivez votre parcours : nous l’étudions au regard des missions en cours et à venir.'
            : 'Nous sommes situés dans le IIᵉ arrondissement d’Antananarivo, en bord de route, dans le quartier de Tsiadana. Si vous êtes dans le coin, n’hésitez pas à passer.'"
        :breadcrumbs="$breadcrumbs"
    />

    <section class="section bg-white">
        <div class="container mx-auto grid lg:grid-cols-12 gap-12">

            <aside class="lg:col-span-5 space-y-10">
                <div>
                    <p class="eyebrow">Nous joindre</p>
                    <h2 class="mt-4 text-display-lg text-ink-900 tracking-tight">Un interlocuteur, pas un standard.</h2>
                    <p class="mt-6 text-ink-500 leading-relaxed">
                        Écrivez-nous, appelez-nous ou passez nous voir : chaque prise de contact reçoit une réponse
                        personnalisée sous 24h ouvrées.
                    </p>
                </div>

                <dl class="space-y-6">
                    <div class="border-l-2 border-brand-500 pl-5">
                        <dt class="rule-label">Adresse</dt>
                        <dd class="mt-2 text-ink-800 font-medium">
                            {{ $company['address']['street'] }}<br>
                            {{ $company['address']['zip'] }} {{ $company['address']['city'] }}, {{ $company['address']['country'] }}
                        </dd>
                    </div>
                    <div class="border-l-2 border-ink-200 pl-5">
                        <dt class="rule-label">Téléphone</dt>
                        <dd class="mt-2 text-ink-800 font-medium">
                            <a class="hover:text-brand-600 transition" href="tel:{{ str_replace(' ', '', $company['phone_fr']) }}">{{ $company['phone_fr'] }}</a><br>
                            <a class="hover:text-brand-600 transition" href="tel:{{ str_replace(' ', '', $company['phone_mg']) }}">{{ $company['phone_mg'] }}</a>
                        </dd>
                    </div>
                    <div class="border-l-2 border-ink-200 pl-5">
                        <dt class="rule-label">E-mail</dt>
                        <dd class="mt-2 text-ink-800 font-medium">
                            <a class="hover:text-brand-600 transition" href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a>
                        </dd>
                    </div>
                    <div class="border-l-2 border-ink-200 pl-5">
                        <dt class="rule-label">Horaires</dt>
                        <dd class="mt-2 space-y-1 text-ink-700">
                            @foreach ($company['hours'] as $h)
                                <p><span class="font-medium text-ink-900">{{ $h['days'] }}</span> — {{ $h['hours'] }}</p>
                            @endforeach
                        </dd>
                    </div>
                </dl>
            </aside>

            <div class="lg:col-span-7">
                <div class="rounded-2xl bg-paper-50 border border-ink-100 p-8 md:p-10">
                    <h2 class="text-2xl font-display text-ink-900 tracking-tight">{{ $isCandidature ? 'Votre candidature' : 'Écrivez-nous' }}</h2>
                    <p class="mt-2 text-ink-500">Les champs marqués d’un <span class="text-brand-600">*</span> sont obligatoires.</p>

                    @if (session('status'))
                        <div class="mt-6 rounded-lg border border-brand-500/30 bg-brand-50 px-5 py-4 text-brand-700 text-sm" role="status">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="mt-8 space-y-5" enctype="multipart/form-data" novalidate>
                        @csrf

                        @if ($isCandidature)
                            <input type="hidden" name="motif" value="candidature">
                            @if ($posteSlug !== '')
                                <input type="hidden" name="poste" value="{{ $posteSlug }}">
                            @endif
                        @endif

                        <div class="hidden" aria-hidden="true">
                            <label>Site web<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-5">
                            <label class="block">
                                <span class="text-sm font-medium text-ink-700">Nom <span class="text-brand-600" aria-hidden="true">*</span></span>
                                <input type="text" name="name" required autocomplete="family-name"
                                       value="{{ old('name') }}"
                                       class="mt-2 block w-full rounded-lg border-ink-200 bg-white focus:border-brand-500 focus:ring-brand-500">
                                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </label>
                            <label class="block">
                                <span class="text-sm font-medium text-ink-700">Prénom <span class="text-brand-600" aria-hidden="true">*</span></span>
                                <input type="text" name="firstname" required autocomplete="given-name"
                                       value="{{ old('firstname') }}"
                                       class="mt-2 block w-full rounded-lg border-ink-200 bg-white focus:border-brand-500 focus:ring-brand-500">
                                @error('firstname')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </label>
                        </div>

                        <div class="grid sm:grid-cols-2 gap-5">
                            <label class="block">
                                <span class="text-sm font-medium text-ink-700">Entreprise</span>
                                <input type="text" name="company" autocomplete="organization"
                                       value="{{ old('company') }}"
                                       class="mt-2 block w-full rounded-lg border-ink-200 bg-white focus:border-brand-500 focus:ring-brand-500">
                                @error('company')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </label>
                            <label class="block">
                                <span class="text-sm font-medium text-ink-700">Téléphone</span>
                                <input type="tel" name="phone" autocomplete="tel"
                                       value="{{ old('phone') }}"
                                       class="mt-2 block w-full rounded-lg border-ink-200 bg-white focus:border-brand-500 focus:ring-brand-500">
                                @error('phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </label>
                        </div>

                        <label class="block">
                            <span class="text-sm font-medium text-ink-700">E-mail <span class="text-brand-600" aria-hidden="true">*</span></span>
                            <input type="email" name="email" required autocomplete="email"
                                   value="{{ old('email') }}"
                                   class="mt-2 block w-full rounded-lg border-ink-200 bg-white focus:border-brand-500 focus:ring-brand-500">
                            @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </label>

                        <label class="block">
                            <span class="text-sm font-medium text-ink-700">{{ $isCandidature ? 'Votre message' : 'Vos besoins' }} <span class="text-brand-600" aria-hidden="true">*</span></span>
                            <textarea name="content" rows="6" required
                                      class="mt-2 block w-full rounded-lg border-ink-200 bg-white focus:border-brand-500 focus:ring-brand-500">{{ old('content', $isCandidature ? $candidaturePrefill : '') }}</textarea>
                            @error('content')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </label>

                        @if ($isCandidature)
                            <label class="block">
                                <span class="text-sm font-medium text-ink-700">CV <span class="text-brand-600" aria-hidden="true">*</span></span>
                                <input type="file" name="cv" required
                                       accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                       class="mt-2 block w-full rounded-lg border-ink-200 bg-white focus:border-brand-500 focus:ring-brand-500">
                                <span class="mt-1 block text-xs text-ink-400">PDF ou Word (.pdf, .doc, .docx) — 5 Mo maximum.</span>
                                @error('cv')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </label>
                        @endif

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2">
                            <p class="text-xs text-ink-400">
                                En envoyant ce formulaire, vous consentez au traitement de vos données pour être recontacté(e).
                            </p>
                            <button type="submit" class="btn-primary">
                                {{ $isCandidature ? 'Envoyer votre candidature' : 'Envoyer votre demande' }}
                                <svg aria-hidden="true" viewBox="0 0 20 20" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 10h12M12 5l5 5-5 5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-paper-50 border-t border-ink-100">
        <div class="container mx-auto py-12 grid lg:grid-cols-12 gap-8 items-start">
            <div class="lg:col-span-4">
                <p class="eyebrow">Où nous trouver</p>
                <h2 class="mt-4 text-2xl font-display text-ink-900 tracking-tight">Antananarivo — Ampasanimalo/Tsiadana.</h2>
                <p class="mt-4 text-ink-500 leading-relaxed">
                    Un accès simple, en bord de route. Un café vous attend si vous êtes de passage.
                </p>
            </div>
            <div class="lg:col-span-8">
                <div class="aspect-[16/9] overflow-hidden rounded-2xl shadow-soft bg-white">
                    <iframe
                        title="Plan d’accès BSM-Services, Antananarivo"
                        src="https://www.google.com/maps?q=Immeuble+Le+Colisée+Ampasanimalo+Tsiadana+Antananarivo&hl=fr&z=16&output=embed"
                        width="100%" height="100%"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        style="border:0"></iframe>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
