<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Merchant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merchants = Merchant::all();
        $merchants->each(function ($merchant) {
            Menu::factory()
                ->count(12)
                ->for($merchant)
                ->create();
        });
    }
}
