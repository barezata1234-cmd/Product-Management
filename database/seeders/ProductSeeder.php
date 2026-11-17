<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Seed the database with 20 random products using the Product factory
        Product::factory()->count(20)->create();
    }
}