<?php

namespace App\Http\Controllers;

use App\Data\SiteData;
use Illuminate\View\View;

class RecrutementController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.recrutement', [
            'recruitment' => SiteData::recruitment(),
        ]);
    }
}
