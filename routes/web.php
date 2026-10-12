<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - BST13 TechSolutions
|--------------------------------------------------------------------------
*/

// Halaman Utama & Katalog Layanan
Route::get('/', [HomeController::class, 'index'])->name('home');

// Formulir Konsultasi Cepat (Redirect ke WhatsApp dengan pesan terformat)
Route::post('/konsultasi', [HomeController::class, 'consult'])->name('consult');

// Direct WhatsApp Redirect per Layanan
Route::get('/layanan/{slug}/whatsapp', [HomeController::class, 'redirectService'])->name('service.whatsapp');

/*
|--------------------------------------------------------------------------
| Admin Layout Routes - BST TechSolution
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\LayoutAdminController;

Route::prefix('admin')->group(function () {
    // Guest Admin Auth
    Route::get('/login', [LayoutAdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [LayoutAdminController::class, 'authenticate'])->name('admin.login.post');
    Route::post('/logout', [LayoutAdminController::class, 'logout'])->name('admin.logout');

    // Protected Admin Layout Area
    Route::middleware('admin.layout')->group(function () {
        Route::get('/', [LayoutAdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/dashboard', [LayoutAdminController::class, 'dashboard']);

        // Hero & Background Jasa
        Route::get('/hero', [LayoutAdminController::class, 'hero'])->name('admin.hero');
        Route::post('/hero', [LayoutAdminController::class, 'updateHero'])->name('admin.hero.post');

        // Services CRUD
        Route::get('/services', [LayoutAdminController::class, 'services'])->name('admin.services');
        Route::get('/services/create', [LayoutAdminController::class, 'createService'])->name('admin.services.create');
        Route::post('/services', [LayoutAdminController::class, 'storeService'])->name('admin.services.store');
        Route::get('/services/{service}/edit', [LayoutAdminController::class, 'editService'])->name('admin.services.edit');
        Route::put('/services/{service}', [LayoutAdminController::class, 'updateService'])->name('admin.services.update');
        Route::delete('/services/{service}', [LayoutAdminController::class, 'deleteService'])->name('admin.services.delete');

        // Media & Backgrounds Gallery
        Route::get('/media', [LayoutAdminController::class, 'media'])->name('admin.media');

        // Keunggulan & Alur Layanan
        Route::get('/advantages', [LayoutAdminController::class, 'advantages'])->name('admin.advantages');
        Route::post('/advantages', [LayoutAdminController::class, 'updateAdvantages'])->name('admin.advantages.post');

        // Business, WhatsApp & Workshop Info
        Route::get('/business', [LayoutAdminController::class, 'business'])->name('admin.business');
        Route::post('/business', [LayoutAdminController::class, 'updateBusiness'])->name('admin.business.post');
    });
});
