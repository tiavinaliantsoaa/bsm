<?php

namespace App\Http\Controllers;

use App\Data\SiteData;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.about', [
            'director' => SiteData::director(),
            'values'   => SiteData::values(),
            'facts'    => SiteData::facts(),
        ]);
    }
}
