<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')
    ->prefix('config')
    ->as('config.')
    ->controller(DashboardController::class)
    ->group(function () {
        Route::get('/help', 'help')->name('help');
        Route::get('/settings', 'settings')->name('settings');
    });

Route::middleware('auth')
    ->controller(ProfileController::class)
    ->prefix('profile')
    ->as('profile.')
    ->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

require __DIR__ . '/auth.php';
require __DIR__ . '/development.php';
