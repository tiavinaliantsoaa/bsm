<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class LegalController extends Controller
{
    public function mentions(): View
    {
        return view('pages.mentions-legales');
    }

    public function sitemap(): View
    {
        return view('pages.plan-du-site');
    }
}
