<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Generate a random category name from a predefined list
            'name' => fake()->randomElement([
                'Mobile Phones',
                'Laptops',
                'Accessories',
                'Tablets',
            ]),

            'description' => fake()->sentence(),
        ];
    }
}