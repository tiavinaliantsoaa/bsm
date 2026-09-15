@props(['service', 'index' => 0, 'total' => 0])

<a href="{{ route('services.show', $service['slug']) }}"
   class="group card p-8 flex flex-col h-full focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-500">

    <div class="flex items-start justify-between gap-4">
        <span class="rule-label">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }} / {{ str_pad((string) ($total ?? 0), 2, '0', STR_PAD_LEFT) }}</span>
        <x-service-icon :name="$service['icon']" class="w-8 h-8 text-brand-500" />
    </div>

    <h3 class="mt-8 text-2xl font-display text-ink-900 tracking-tight leading-snug">{{ $service['title'] }}</h3>
    <p class="mt-3 text-ink-500 leading-relaxed">{{ $service['summary'] }}</p>

    <span class="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-ink-800 group-hover:text-brand-600 transition">
        Voir la prestation
        <svg aria-hidden="true" class="w-4 h-4 transition group-hover:translate-x-1" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 10h12M12 5l5 5-5 5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </span>
</a>
