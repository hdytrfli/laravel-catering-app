<?php

use App\Models\User;
use App\Enums\RoleType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

if (app()->environment('local')) {
    Route::middleware('auth')
        ->as('development.')
        ->prefix('development')
        ->group(function () {
            Route::get('migrate', function () {
                $user = Auth::user();
                Artisan::call('migrate:fresh', ['--seed' => true]);

                Auth::loginUsingId($user->id);
                return back()->with('success', 'Database migrated and seeded successfully.');
            })->name('migrate');

            Route::get('reset', function () {
                $user = Auth::user();
                Artisan::call('migrate:fresh');
                Artisan::call('db:seed', ['--class' => 'UserSeeder']);

                Auth::loginUsingId($user->id);
                return back()->with('success', 'Database migrated successfully.');
            })->name('reset');

            Route::get('impersonate', function () {
                $merchant = User::where('role', RoleType::MERCHANT)->first();
                $customer = User::where('role', RoleType::CUSTOMER)->first();
                $role = request('role');

                match ($role) {
                    RoleType::MERCHANT->value => Auth::login($merchant),
                    RoleType::CUSTOMER->value => Auth::login($customer),
                };
                return back()->with('success', 'Impersonated as ' . $role);
            })->name('impersonate');
        });
}
