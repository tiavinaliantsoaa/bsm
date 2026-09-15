@props([
    'eyebrow' => null,
    'title',
    'lead' => null,
    'image' => null,
    'imageAlt' => '',
    'imageMode' => 'photo',
    'breadcrumbs' => [],
    'variant' => 'default',
])

@if ($variant === 'compact')
    <section class="relative overflow-hidden bg-ink-900 text-white">
        @if ($image)
            <img src="{{ $image }}" alt="{{ $imageAlt }}" width="1920" height="640"
                 class="absolute inset-0 h-full w-full object-cover opacity-30" loading="eager" decoding="async">
            <div class="absolute inset-0 bg-gradient-to-b from-ink-900/70 via-ink-900/60 to-ink-900"></div>
        @endif

        <div class="relative container mx-auto pt-28 pb-16 md:pt-36 md:pb-24">
            @if (count($breadcrumbs))
                <nav aria-label="Fil d’Ariane" class="mb-8">
                    <ol class="flex flex-wrap items-center gap-2 text-xs uppercase tracking-[0.18em] text-white/60">
                        @foreach ($breadcrumbs as $i => $bc)
                            <li class="flex items-center gap-2">
                                @if ($i > 0) <span aria-hidden="true">/</span> @endif
                                @if (!empty($bc['url']) && !$loop->last)
                                    <a href="{{ $bc['url'] }}" class="hover:text-white transition">{{ $bc['label'] }}</a>
                                @else
                                    <span class="text-white">{{ $bc['label'] }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            @endif

            @if ($eyebrow)<p class="eyebrow text-brand-400">{{ $eyebrow }}</p>@endif
            <h1 class="mt-6 text-display-xl text-white max-w-4xl">{{ $title }}</h1>
            @if ($lead)
                <p class="mt-6 text-lg md:text-xl text-white/70 max-w-2xl leading-relaxed">{{ $lead }}</p>
            @endif
        </div>
    </section>
@else
    <section @class([
        'relative bg-white' => $imageMode === 'illustration',
        'relative overflow-hidden bg-paper-50' => $imageMode !== 'illustration',
    ])>
        @if ($imageMode !== 'illustration')
            <div aria-hidden="true"
                 class="absolute -top-24 -right-24 w-[520px] h-[520px] rounded-full bg-brand-500/10 blur-3xl"></div>
        @endif

        <div @class([
            'container mx-auto grid lg:grid-cols-12',
            'pt-8 pb-8 gap-8 lg:gap-12 items-start' => $imageMode === 'illustration',
            'pt-24 md:pt-32 pb-24 md:pb-32 gap-12 lg:gap-16 items-center' => $imageMode !== 'illustration',
        ])>
            <div @class(['lg:col-span-6' => $imageMode === 'illustration', 'lg:col-span-7' => $imageMode !== 'illustration'])>
                @if ($eyebrow)<p class="eyebrow">{{ $eyebrow }}</p>@endif
                <h1 @class([
                    'mt-4 text-ink-900 tracking-tight',
                    'text-display-xl' => $imageMode === 'illustration',
                    'text-display-2xl' => $imageMode !== 'illustration',
                ])>{{ $title }}</h1>
                @if ($lead)
                    <p @class([
                        'mt-6 leading-relaxed',
                        'text-lg text-ink-600 max-w-lg' => $imageMode === 'illustration',
                        'text-xl text-ink-500 max-w-2xl' => $imageMode !== 'illustration',
                    ])>{{ $lead }}</p>
                @endif
                <div class="mt-6 flex flex-wrap gap-3">
                    {{ $actions ?? '' }}
                </div>

                <dl class="mt-8 grid grid-cols-3 gap-6 max-w-lg">
                    <div>
                        <dt class="rule-label">Depuis</dt>
                        <dd class="mt-1 text-2xl font-display text-ink-800">2016</dd>
                    </div>
                    <div>
                        <dt class="rule-label">Profils</dt>
                        <dd class="mt-1 text-2xl font-display text-ink-800">Bac +4/5</dd>
                    </div>
                    <div>
                        <dt class="rule-label">Basés à</dt>
                        <dd class="mt-1 text-2xl font-display text-ink-800">Antananarivo</dd>
                    </div>
                </dl>
            </div>

            @if ($imageMode === 'illustration')
                <div class="lg:col-span-6 lg:mt-10">
                    @if ($image)
                        <img src="{{ $image }}" alt="{{ $imageAlt }}"
                             width="755" height="555" loading="eager" fetchpriority="high" decoding="async"
                             class="w-full h-auto">
                    @endif
                </div>
            @else
                <div class="lg:col-span-5 relative">
                    <div class="relative aspect-[4/5] overflow-hidden rounded-2xl shadow-lift bg-navy-800">
                        @if ($image)
                            <img src="{{ $image }}" alt="{{ $imageAlt }}"
                                 width="720" height="900" loading="eager" fetchpriority="high" decoding="async"
                                 class="h-full w-full object-cover">
                        @endif
                        <div class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-ink-900/80 via-ink-900/40 to-transparent">
                            <p class="text-white/90 text-sm leading-relaxed max-w-xs">
                                « Nous partageons vos points communs&nbsp;: flexibilité, agilité, mindset. »
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endif
