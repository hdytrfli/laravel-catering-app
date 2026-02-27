<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RoleType;
use App\Models\Customer;
use App\Models\Merchant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Merchant::factory()->create([
            'user_id' => User::factory()->create([
                'name' => 'Merchant',
                'email' => 'merchant@example.com',
                'role' => RoleType::MERCHANT,
            ])->id,
        ]);

        Customer::factory()->create([
            'user_id' => User::factory()->create([
                'name' => 'Customer',
                'email' => 'customer@example.com',
                'role' => RoleType::CUSTOMER,
            ])->id,
        ]);
    }
}
