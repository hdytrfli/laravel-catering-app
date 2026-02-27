<?php

namespace App\Http\Controllers;

use App\Enums\RoleType;
use Illuminate\View\View;
use App\Enums\CategoryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Enum;

class RoleController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        $user = Auth::user();
        return match ($user->role) {
            RoleType::MERCHANT => view('profile.merchant.edit', [
                'categories' => CategoryType::cases(),
            ]),
            RoleType::CUSTOMER => view('profile.customer.edit'),
        };
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = match ($user->role) {
            RoleType::MERCHANT => $request->validate([
                'phone' => ['required', 'string', 'max:20'],
                'company' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:500'],
                'website' => ['nullable', 'url', 'max:255'],
                'description' => ['nullable', 'string'],
                'category' => ['required', new Enum(CategoryType::class)],
            ]),
            RoleType::CUSTOMER => $request->validate([
                'phone' => ['required', 'string', 'max:20'],
                'address' => ['required', 'string', 'max:500'],
            ]),
        };

        $profile = match ($user->role) {
            RoleType::MERCHANT => $user->merchant,
            RoleType::CUSTOMER => $user->customer,
        };

        $profile->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Profile updated successfully.');
    }
}
