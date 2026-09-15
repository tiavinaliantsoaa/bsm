@props(['size' => 'md'])

<span {{ $attributes->class([
    'font-brand text-brand-500 uppercase',
    'text-lg tracking-[0.06em]' => $size === 'md',
    'text-xl tracking-[0.06em]' => $size === 'lg',
]) }}>BSM-SERVICES</span>
