<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\RecrutementController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', HomeController::class)->name('home');

// Company
Route::get('/a-propos', AboutController::class)->name('about');
Route::redirect('/bsm-services', '/a-propos', 301);

// Services (index + individual service pages)
Route::get('/nos-prestations', [ServiceController::class, 'index'])->name('services.index');
Route::redirect('/nos-prestations/marketing', '/nos-prestations/web-marketing', 301);
Route::get('/nos-prestations/{slug}', [ServiceController::class, 'show'])->name('services.show')->where('slug', '[a-z0-9\-]+');

// Recrutement (replaces the former blog)
Route::get('/recrutement', RecrutementController::class)->name('recrutement');
Route::redirect('/blog', '/recrutement', 301);
Route::redirect('/blog/{slug}', '/recrutement', 301)->where('slug', '[a-z0-9\-]+');

// Contact (GET + POST)
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contact.store');

// Legal
Route::get('/mentions-legales', [LegalController::class, 'mentions'])->name('legal.mentions');
Route::get('/plan-du-site', [LegalController::class, 'sitemap'])->name('legal.sitemap');

// XML sitemap for search engines
Route::get('/sitemap.xml', SitemapController::class);
