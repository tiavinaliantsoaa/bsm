@props(['items' => []])

@php
    $itemListElement = [];
    foreach ($items as $i => $bc) {
        $itemListElement[] = [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $bc['label'],
            'item'     => $bc['url'] ?? url()->current(),
        ];
    }
@endphp

<script type="application/ld+json">
{!! json_encode([
    '@'.'context' => 'https://schema.org',
    '@type'    => 'BreadcrumbList',
    'itemListElement' => $itemListElement,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
</script>
