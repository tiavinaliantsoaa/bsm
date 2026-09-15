<?php

namespace App\Http\Controllers;

use App\Data\SiteData;
use Illuminate\Http\Response;

/**
 * Emits a machine-readable /sitemap.xml for search engines.
 * Small enough to render on the fly; no need for filesystem caching.
 */
class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = [
            ['loc' => route('home'),            'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => route('about'),           'priority' => '0.9', 'changefreq' => 'monthly'],
            ['loc' => route('services.index'),  'priority' => '0.9', 'changefreq' => 'monthly'],
            ['loc' => route('recrutement'),     'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => route('contact.show'),    'priority' => '0.7', 'changefreq' => 'yearly'],
            ['loc' => route('legal.mentions'),  'priority' => '0.2', 'changefreq' => 'yearly'],
            ['loc' => route('legal.sitemap'),   'priority' => '0.2', 'changefreq' => 'yearly'],
        ];

        foreach (SiteData::services() as $s) {
            $urls[] = [
                'loc' => route('services.show', $s['slug']),
                'priority' => '0.8',
                'changefreq' => 'monthly',
            ];
        }
        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }
}
