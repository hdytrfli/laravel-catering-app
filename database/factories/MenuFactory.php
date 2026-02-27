<?php

namespace Database\Factories;

use App\Models\Merchant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(2),
            'description' => fake()->sentence(8),
            'calories' => fake()->numberBetween(200, 1000),
            'carbs' => fake()->numberBetween(10, 150),
            'protein' => fake()->numberBetween(5, 50),
            'fat' => fake()->numberBetween(5, 60),
            'price' => fake()->numberBetween(10, 40) * 1000,
            'image' => null,
            'merchant_id' => Merchant::factory(),
        ];
    }
}
