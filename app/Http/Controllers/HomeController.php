<?php

namespace App\Http\Controllers;

use App\Data\SiteData;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.home', [
            'services' => SiteData::services(),
            'values'   => SiteData::values(),
            'director' => SiteData::director(),
            'facts'       => SiteData::facts(),
            'recruitment' => SiteData::recruitment(),
        ]);
    }
}
