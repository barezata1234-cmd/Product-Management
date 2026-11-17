<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
            // Seed the database with 4 random categories using the Category factory
        Category::factory()->count(4)->create();
    }
}