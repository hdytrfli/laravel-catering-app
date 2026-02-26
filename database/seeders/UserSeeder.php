<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RoleType;
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
        User::factory()->create([
            'name' => 'Merchant',
            'email' => 'merchant@example.com',
            'role' => RoleType::MERCHANT,
        ]);

        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
            'role' => RoleType::CUSTOMER,
        ]);
    }
}
