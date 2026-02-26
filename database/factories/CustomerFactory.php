<?php

namespace Database\Factories;

use App\Models\User;
use App\Enums\RoleType;
use Database\Factories\Concerns\FakerExtension;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    use FakerExtension;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => $this->indonesian_phone(),
            'address' => fake()->address(),
            'latitude' => fake()->latitude(-6.3, -6.1),
            'longitude' => fake()->longitude(106.7, 106.9),
            'avatar' => null,
            'user_id' => User::factory([
                'role' => RoleType::CUSTOMER,
            ]),
        ];
    }
}
