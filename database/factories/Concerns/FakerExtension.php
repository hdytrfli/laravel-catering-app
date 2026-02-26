<?php

namespace Database\Factories\Concerns;

use Illuminate\Support\Str;

trait FakerExtension
{
    protected function indonesian_phone(): string
    {
        $prefixes = ['811', '812', '813', '821', '822', '851', '852', '853'];
        return '+62' . fake()->randomElement($prefixes) . fake()->numerify('#######');
    }

    protected function custom_email(string $name): string
    {
        return Str::slug($name, '.') . '@example.com';
    }

    protected function full_name(): string
    {
        return fake()->firstName() . ' ' . fake()->lastName();
    }
}
