<!doctype html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0E1E36">

    {{-- SEO ---------------------------------------------------------------- --}}
    @php
        $pageTitle       = ($title ?? null) ? $title.' — '.$company['name'] : $company['name'].' — '.$company['tagline'];
        $pageDescription = $description ?? 'BSM-Services accompagne PME et start-ups grâce à des profils cadres Bac+4/5 basés à Antananarivo. Externalisation, commercial, veille, web marketing, RH, études.';
        $pageImage       = $ogImage ?? asset('assets/images/pages/home-hero.jpg');
        $canonical       = $canonical ?? url()->current();
    @endphp

    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $pageDescription }}">
    <link rel="canonical" href="{{ $canonical }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $company['name'] }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:image" content="{{ $pageImage }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $pageImage }}">

    {{-- Favicons ----------------------------------------------------------- --}}
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    {{-- Fonts: Gravity + Source Serif 4 are bundled via Vite (see app.css) --}}

    {{-- Vite assets -------------------------------------------------------- --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Organization + LocalBusiness JSON-LD, present on every page -------- --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@'.'context' => 'https://schema.org',
        '@type'    => 'ProfessionalService',
        'name'     => $company['name'],
        'description' => $company['tagline'],
        'url'      => url('/'),
        'logo'     => asset('assets/images/logo.svg'),
        'email'    => $company['email'],
        'telephone'=> $company['phone_fr'],
        'foundingDate' => (string) $company['founded'],
        'address'  => [
            '@type'          => 'PostalAddress',
            'streetAddress'  => $company['address']['street'],
            'postalCode'     => $company['address']['zip'],
            'addressLocality'=> $company['address']['city'],
            'addressCountry' => 'MG',
        ],
        'geo' => [
            '@type'    => 'GeoCoordinates',
            'latitude' => $company['address']['geo']['lat'],
            'longitude'=> $company['address']['geo']['lng'],
        ],
        'sameAs' => [$company['linkedin']],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>

    @stack('head')
</head>
<body class="min-h-screen flex flex-col">

    {{-- Accessible skip link ---------------------------------------------- --}}
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:top-3 focus:left-3 focus:z-50 focus:bg-white focus:text-ink-800 focus:px-4 focus:py-2 focus:rounded-md focus:shadow-lift">
        Aller au contenu
    </a>

    <x-navbar />

    <main id="main" class="flex-1">
        {{ $slot }}
    </main>

    <x-footer />

    @stack('scripts')
</body>
</html>
