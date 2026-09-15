@props(['name'])

@php
    // Hand-drawn SVGs — avoids stock/generic look of icon libraries.
    $paths = [
        'briefcase' => '<path d="M4 8h24v18H4z"/><path d="M12 8V6a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M4 15h24"/>',
        'radar'     => '<circle cx="16" cy="16" r="12"/><circle cx="16" cy="16" r="7"/><circle cx="16" cy="16" r="2.5"/><path d="M16 4v6M28 16h-6"/>',
        'compass'   => '<circle cx="16" cy="16" r="12"/><path d="M20 12l-2 6-6 2 2-6 6-2z" stroke-linejoin="round"/>',
        'users'     => '<circle cx="12" cy="12" r="4"/><path d="M4 26c0-4.4 3.6-8 8-8s8 3.6 8 8"/><circle cx="22" cy="14" r="3"/><path d="M20 26c0-3.5 2.5-6 6-6"/>',
        'chart'     => '<path d="M4 26h24"/><rect x="7" y="16" width="4" height="10"/><rect x="14" y="10" width="4" height="16"/><rect x="21" y="6" width="4" height="20"/>',
        'sparkle'   => '<path d="M16 4l2.5 7.5L26 14l-7.5 2.5L16 24l-2.5-7.5L6 14l7.5-2.5z" stroke-linejoin="round"/>',
        'megaphone' => '<path d="M6 14h4l12-6v16L10 18H6z"/><path d="M10 18v4a3 3 0 0 0 3 3"/><path d="M6 14v4h4v-4"/>',
        'ledger'    => '<rect x="6" y="4" width="20" height="24" rx="1"/><path d="M10 10h12M10 16h12M10 22h8"/>',
        'code'      => '<path d="M10 8L4 16l6 8M22 8l6 8-6 8M18 6l-4 20"/>',
        'server'    => '<rect x="5" y="5" width="22" height="8" rx="1"/><rect x="5" y="19" width="22" height="8" rx="1"/><path d="M9 9h.01M9 23h.01M13 9h6M13 23h6"/>',
    ];
@endphp

<svg {{ $attributes->merge(['viewBox' => '0 0 32 32', 'fill' => 'none', 'stroke' => 'currentColor', 'stroke-width' => '1.75', 'aria-hidden' => 'true']) }}>
    {!! $paths[$name] ?? $paths['sparkle'] !!}
</svg>
