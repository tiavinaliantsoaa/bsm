@props([])

{{-- Sticky, translucent nav that gains a solid background on scroll --}}
<header
    x-data="{ scrolled: false, open: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 8, { passive: true })"
    :class="scrolled || open
        ? 'bg-white/95 backdrop-blur border-b border-ink-100'
        : 'bg-transparent border-b border-transparent'"
    class="sticky top-0 z-40 transition-colors duration-300"
>
    <nav class="container mx-auto flex items-center justify-between gap-6 py-4 lg:py-5" aria-label="Navigation principale">

        <a href="{{ route('home') }}" class="flex items-center gap-3 group" aria-label="{{ $company['name'] }} — Accueil">
            <span class="leading-tight">
                <x-brand-name class="transition group-hover:text-brand-600" />
                <span class="hidden sm:block text-[10px] uppercase tracking-[0.22em] text-ink-400">Externalisation cadres</span>
            </span>
        </a>

        <ul class="hidden lg:flex items-center gap-8 text-sm text-ink-600">
            @foreach ($navigation as $item)
                @php $active = request()->routeIs($item['route']) || request()->routeIs($item['route'].'.*'); @endphp
                <li>
                    <a
                        href="{{ route($item['route']) }}"
                        @class([
                            'relative py-2 transition hover:text-ink-900',
                            'text-ink-900' => $active,
                        ])
                        @if($active) aria-current="page" @endif
                    >
                        {{ $item['label'] }}
                        <span @class([
                            'absolute left-0 -bottom-0.5 h-px bg-brand-500 transition-all duration-500 ease-out-expo',
                            'w-full' => $active,
                            'w-0'    => !$active,
                        ])></span>
                    </a>
                </li>
            @endforeach
        </ul>

        <a href="{{ route('contact.show') }}" class="hidden lg:inline-flex btn-primary text-xs">
            Discutons de votre projet
            <svg aria-hidden="true" viewBox="0 0 20 20" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 10h12M12 5l5 5-5 5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>

        <button
            type="button"
            @click="open = !open"
            class="lg:hidden inline-flex items-center justify-center w-11 h-11 rounded-full border border-ink-200 bg-white text-ink-700 hover:bg-paper-100"
            :aria-expanded="open.toString()"
            aria-controls="mobile-menu"
            aria-label="Ouvrir le menu"
        >
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
            <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 6l12 12M6 18L18 6"/></svg>
        </button>
    </nav>

    <div
        id="mobile-menu"
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out-expo duration-300"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-out duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="lg:hidden border-t border-ink-100 bg-white"
    >
        <ul class="container mx-auto py-6 space-y-1">
            @foreach ($navigation as $item)
                <li>
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center justify-between rounded-lg px-4 py-3 text-ink-700 hover:bg-paper-100"
                       @click="open = false">
                        <span>{{ $item['label'] }}</span>
                        <svg aria-hidden="true" class="w-4 h-4 text-ink-300" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 5l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </li>
            @endforeach
            <li class="pt-4">
                <a href="{{ route('contact.show') }}" class="btn-primary w-full">
                    Discutons de votre projet
                </a>
            </li>
        </ul>
    </div>
</header>
