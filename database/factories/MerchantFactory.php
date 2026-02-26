<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\RoleType;
use App\Enums\CategoryType;
use Database\Factories\Concerns\FakerExtension;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Merchant>
 */
class MerchantFactory extends Factory
{
    use FakerExtension;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = CategoryType::values();

        return [
            'phone' => $this->indonesian_phone(),
            'company' => fake()->company(),
            'address' => fake()->address(),
            'website' => 'https://example.com',
            'description' => fake()->sentence(12),
            'category' => fake()->randomElement($categories),
            'latitude' => fake()->latitude(-6.3, -6.1),
            'longitude' => fake()->longitude(106.7, 106.9),
            'avatar' => null,
            'backdrop' => null,
            'user_id' => User::factory([
                'role' => RoleType::MERCHANT,
            ]),
        ];
    }
}
