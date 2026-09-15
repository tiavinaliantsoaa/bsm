@props([
    'eyebrow' => null,
    'title',
    'lead' => null,
    'align' => 'left',
])

<header @class([
    'max-w-3xl',
    'mx-auto text-center' => $align === 'center',
])>
    @if ($eyebrow) <p class="eyebrow">{{ $eyebrow }}</p> @endif

    <div @class(['mt-4 inline-block', 'mx-auto' => $align === 'center'])>
        <h2 class="text-display-lg text-ink-900 tracking-tight">{{ $title }}</h2>
        <span class="mt-3 block h-0.5 w-1/2 bg-brand-500" aria-hidden="true"></span>
    </div>

    @if ($lead)
        <p @class([
            'mt-5 text-lg text-ink-500 leading-relaxed measure',
            'mx-auto' => $align === 'center',
        ])>{{ $lead }}</p>
    @endif
</header>
