<?php

use App\Http\Controllers\CemeteryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GraveController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::resource('cemeteries', CemeteryController::class);
Route::resource('graves', GraveController::class);
Route::resource('persons', PersonController::class);

Route::get('/cemeteries/{cemetery}/edit-boundary', [CemeteryController::class, 'editBoundary'])->name('cemeteries.edit-boundary');
Route::put('/cemeteries/{cemetery}/update-boundary', [CemeteryController::class, 'updateBoundary'])->name('cemeteries.update-boundary');

Route::get('/graves/{grave}/edit-boundary', [GraveController::class, 'editBoundary'])->name('graves.edit-boundary');
Route::put('/graves/{grave}/update-boundary', [GraveController::class, 'updateBoundary'])->name('graves.update-boundary');

Route::get('dashboard/heatmap', [DashboardController::class, 'heatmapData']);
Route::get('/dashboard', fn() => Inertia::render('Dashboard/LivingHeritage'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
