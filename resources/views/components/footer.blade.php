<footer class="mt-auto bg-ink-900 text-ink-200">
    <div class="container mx-auto py-20 grid gap-14 md:grid-cols-2 lg:grid-cols-12">

        <div class="lg:col-span-4">
            <a href="{{ route('home') }}" class="inline-flex items-center" aria-label="{{ $company['name'] }} — Accueil">
                <x-brand-name size="lg" />
            </a>
            <p class="mt-6 text-ink-300 leading-relaxed max-w-sm">
                {{ $company['baseline'] }}
            </p>

            <div class="mt-8 flex items-center gap-3">
                <a href="{{ $company['linkedin'] }}" target="_blank" rel="noopener"
                   class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-white/10 hover:border-brand-500 hover:text-brand-400 transition"
                   aria-label="BSM-Services sur LinkedIn">
                    <svg viewBox="0 0 24 24" class="w-4 h-4" fill="currentColor" aria-hidden="true">
                        <path d="M4.98 3.5A2.5 2.5 0 1 1 5 8.5a2.5 2.5 0 0 1 0-5zM3 9h4v12H3zM10 9h3.8v1.7h.05c.53-1 1.83-2.05 3.77-2.05 4.03 0 4.78 2.65 4.78 6.1V21h-4v-5.3c0-1.27-.02-2.9-1.77-2.9-1.77 0-2.04 1.38-2.04 2.8V21h-3.99z"/>
                    </svg>
                </a>
            </div>
        </div>

        <div class="lg:col-span-3">
            <p class="text-eyebrow text-brand-400 mb-5">Contact</p>
            <address class="not-italic space-y-3 text-ink-300 text-sm leading-relaxed">
                <p>{{ $company['address']['street'] }}<br>{{ $company['address']['zip'] }} {{ $company['address']['city'] }}, {{ $company['address']['country'] }}</p>
                <p>
                    <a class="hover:text-white transition" href="tel:{{ str_replace(' ', '', $company['phone_fr']) }}">{{ $company['phone_fr'] }}</a><br>
                    <a class="hover:text-white transition" href="tel:{{ str_replace(' ', '', $company['phone_mg']) }}">{{ $company['phone_mg'] }}</a>
                </p>
                <p><a class="text-brand-400 hover:text-white transition" href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a></p>
            </address>
        </div>

        <div class="lg:col-span-3">
            <p class="text-eyebrow text-brand-400 mb-5">Navigation</p>
            <ul class="space-y-3 text-sm">
                <li><a href="{{ route('about') }}"          class="text-ink-300 hover:text-white transition">À propos</a></li>
                <li><a href="{{ route('services.index') }}" class="text-ink-300 hover:text-white transition">Nos prestations</a></li>
                <li><a href="{{ route('recrutement') }}"    class="text-ink-300 hover:text-white transition">Recrutement</a></li>
                <li><a href="{{ route('contact.show') }}"   class="text-ink-300 hover:text-white transition">Contact</a></li>
                <li><a href="{{ route('legal.mentions') }}" class="text-ink-300 hover:text-white transition">Mentions légales</a></li>
                <li><a href="{{ route('legal.sitemap') }}"  class="text-ink-300 hover:text-white transition">Plan du site</a></li>
            </ul>
        </div>

        <div class="lg:col-span-2">
            <p class="text-eyebrow text-brand-400 mb-5">Heures</p>
            <ul class="space-y-3 text-sm text-ink-300">
                @foreach ($company['hours'] as $h)
                    <li>
                        <span class="block text-white">{{ $h['days'] }}</span>
                        <span class="block text-ink-400">{{ $h['hours'] }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="container mx-auto py-6 flex flex-col md:flex-row md:items-center md:justify-between gap-2 text-xs text-ink-400">
            <p>© {{ date('Y') }} {{ $company['legal_name'] }}. Tous droits réservés.</p>
            <p class="flex items-center gap-4">
                <a href="{{ route('legal.mentions') }}" class="hover:text-white transition">Mentions légales</a>
                <span aria-hidden="true">·</span>
                <a href="{{ route('legal.sitemap') }}" class="hover:text-white transition">Plan du site</a>
            </p>
        </div>
    </div>
</footer>
