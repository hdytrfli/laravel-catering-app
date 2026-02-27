<?php

use App\Enums\RoleType;
use App\Models\Merchant;
use App\Helpers\MiddlewareRule;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\DashboardController;

Route::middleware('auth')
    ->controller(DashboardController::class)
    ->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

Route::middleware('auth')
    ->prefix('config')
    ->as('config.')
    ->controller(DashboardController::class)
    ->group(function () {
        Route::get('/help', 'help')->name('help');
        Route::get('/settings', 'settings')->name('settings');
    });

Route::middleware('auth')
    ->prefix('profile')
    ->as('profile.')
    ->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

Route::middleware('auth')
    ->prefix('role')
    ->as('role.')
    ->group(function () {
        Route::get('/edit', [RoleController::class, 'edit'])->name('edit');
        Route::patch('/', [RoleController::class, 'update'])->name('update');
    });

Route::middleware('auth', 'role:' . RoleType::MERCHANT->value)
    ->group(function () {
        Route::resource('menus', MenuController::class);
    });

Route::middleware('auth', 'role:' . RoleType::CUSTOMER->value)
    ->resource('merchants', MerchantController::class)
    ->only([
        'index',
        'show'
    ]);

require __DIR__ . '/auth.php';
require __DIR__ . '/development.php';
