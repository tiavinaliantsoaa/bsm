# BSM-Services — corporate website

Full redesign of [bsm-services.com](http://www.bsm-services.com) as a modern,
premium multi-page site built with **Laravel 13**, **Tailwind CSS**, **Blade
components** and **Vite**. Alpine.js is used sparingly, only where a real
interaction is required (sticky navigation, mobile menu).

The original content is preserved verbatim (with minor grammar/typography
polish); the design language is deliberately editorial — Swiss corporate,
strong visual hierarchy, warm off-white paper background, single orange accent
against a deep ink black.

---

## Requirements

- PHP ≥ 8.3 with the usual Laravel extensions (`mbstring`, `openssl`, `pdo`,
  `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`).
- Composer ≥ 2.6
- Node ≥ 18 (for Vite / Tailwind)
- Any web server able to serve the `/public` directory (Apache, Nginx, or
  `php artisan serve` in development).

## Getting started

```bash
# 1. Install PHP + JS dependencies
composer install
npm install

# 2. Environment
cp .env.example .env
php artisan key:generate

# 3. Build front-end assets (production build)
npm run build

# 4. Serve
php artisan serve
# → http://localhost:8000
```

For a development workflow with hot-reload, run Vite in a second terminal:

```bash
npm run dev
```

---

## Project structure

```
app/
├── Data/
│   └── SiteData.php               ← Single source of truth for content
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php
│   │   ├── AboutController.php
│   │   ├── ServiceController.php
│   │   ├── BlogController.php
│   │   ├── ContactController.php
│   │   ├── LegalController.php
│   │   └── SitemapController.php  ← Renders /sitemap.xml
│   ├── Requests/ContactRequest.php
│   └── ...
├── Mail/ContactMessage.php
└── Providers/AppServiceProvider.php

resources/
├── css/app.css                    ← Tailwind entry + design tokens
├── js/app.js                      ← Alpine bootstrap
└── views/
    ├── components/
    │   ├── layouts/app.blade.php  ← Shared HTML shell + SEO
    │   ├── navbar.blade.php
    │   ├── footer.blade.php
    │   ├── hero.blade.php
    │   ├── section-title.blade.php
    │   ├── service-card.blade.php
    │   ├── service-icon.blade.php
    │   ├── article-card.blade.php
    │   ├── cta-band.blade.php
    │   └── breadcrumb-jsonld.blade.php
    ├── emails/contact.blade.php
    ├── pages/
    │   ├── home.blade.php
    │   ├── about.blade.php
    │   ├── services/{index,show}.blade.php
    │   ├── blog/{index,show}.blade.php
    │   ├── contact.blade.php
    │   ├── mentions-legales.blade.php
    │   └── plan-du-site.blade.php
    └── sitemap.blade.php          ← XML sitemap template

routes/web.php                     ← All named routes
```

## Routes overview

| URL                                 | Name              | Controller                      |
|-------------------------------------|-------------------|---------------------------------|
| `/`                                 | `home`            | `HomeController`                |
| `/bsm-services`                     | `about`           | `AboutController`               |
| `/nos-prestations`                  | `services.index`  | `ServiceController@index`       |
| `/nos-prestations/{slug}`           | `services.show`   | `ServiceController@show`        |
| `/blog`                             | `blog.index`      | `BlogController@index`          |
| `/blog/{slug}`                      | `blog.show`       | `BlogController@show`           |
| `/contact` (GET / POST)             | `contact.show` / `contact.store` | `ContactController` |
| `/mentions-legales`                 | `legal.mentions`  | `LegalController@mentions`      |
| `/plan-du-site`                     | `legal.sitemap`   | `LegalController@sitemap`       |
| `/sitemap.xml`                      | —                 | `SitemapController`             |

## Where does the content live?

All copy, service definitions, values, director quote and the list of blog
articles come from **`app/Data/SiteData.php`**. Because the site is a stable
corporate brochure, storing content in PHP rather than a database keeps
deployments trivial and the site cache-friendly. Adding a new service or
article is a matter of appending an array item.

## SEO & performance features

- Unique `<title>`, meta description, canonical URL and Open Graph / Twitter
  Card tags on every page (composed in `components/layouts/app.blade.php`).
- Semantic HTML: `<header>`, `<nav>`, `<main>`, `<section>`, `<article>`,
  `<footer>`, single `<h1>` per page, logical heading order.
- **JSON-LD** structured data:
  - `ProfessionalService` + `PostalAddress` + `GeoCoordinates` — on every
    page (in the layout).
  - `BreadcrumbList` — pushed by `<x-breadcrumb-jsonld>`.
  - `Service` — on individual service pages.
  - `BlogPosting` — on individual article pages.
- **Sitemap** served at `/sitemap.xml` (also referenced in `robots.txt`).
- **Fonts** loaded async with `media="print"` swap, preconnect to Google
  Fonts and Roboto used from the original site.
- **Images**: explicit `width`/`height`, `loading="lazy"` outside of the
  hero, `decoding="async"`, `fetchpriority="high"` on the LCP image.
- Long-cache HTTP headers on hashed assets via `public/.htaccess`.
- `prefers-reduced-motion` is respected.
- Accessibility: skip-to-content link, visible focus rings, ARIA labels on
  icon-only buttons, `aria-current` on the active nav link, honeypot field
  on the contact form.

## Contact form

Submissions are validated by `App\Http\Requests\ContactRequest` (server-side
validation for all fields, honeypot for bots) and sent via the mailable
`App\Mail\ContactMessage` to the address configured in `CONTACT_TO_ADDRESS`.
If SMTP is not configured (e.g. during local development), messages are
recorded to the `laravel.log` file so no submission is ever silently lost.

## Assets to replace before going to production

- `public/favicon.ico`
- `public/apple-touch-icon.png`
- `public/assets/images/og-default.jpg` (1200×630) — currently a placeholder
  `.txt` note lives beside it.

All other images referenced in the templates come from the original
bsm-services.com CDN.

---

## License

Proprietary — © BSM-Services SARL. All rights reserved.
