<?php

namespace App\Http\Controllers;

use App\Data\SiteData;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('pages.services.index', [
            'services' => SiteData::services(),
        ]);
    }

    public function show(string $slug): View
    {
        $service = SiteData::service($slug);

        if (! $service) {
            throw new NotFoundHttpException("Prestation « {$slug} » introuvable.");
        }

        $related = array_values(array_filter(
            SiteData::services(),
            fn ($s) => in_array($s['slug'], $service['related'], true),
        ));

        return view('pages.services.show', compact('service', 'related'));
    }
}
