<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        // Generate a random product name from a predefined list
        return [
            'name' => fake()->randomElement([
                'Samsung A55',
                'iPhone 15',
                'Redmi Note 13',
                'iPhone 16',
                'Samsung S24',
            ]),
// Assign a random category ID from existing categories in the database
          'category_id' => Category::inRandomOrder()->value('id'),

            'price' => fake()->randomFloat(2, 100, 1500),

            'stock' => fake()->numberBetween(1, 50),

            'is_active' => true,
        ];
    }
}