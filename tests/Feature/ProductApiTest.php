<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_products_can_be_listed_and_shown(): void
    {
        $product = Product::factory()
            ->for(Category::factory())
            ->create();

        $this->getJson('/api/products')
            ->assertOk()
            ->assertJsonCount(1, 'products')
            ->assertJsonPath('products.0.id', $product->id);

        $this->getJson("/api/products/{$product->id}")
            ->assertOk()
            ->assertJsonPath('product.id', $product->id)
            ->assertJsonPath('product.category.id', $product->category_id);
    }

    public function test_products_can_be_created_updated_and_deleted(): void
    {
        $category = Category::factory()->create();
        $attributes = [
            'name' => 'Desk lamp',
            'category_id' => $category->id,
            'price' => 24.50,
            'stock' => 10,
            'is_active' => true,
        ];

        $response = $this->postJson('/api/products', $attributes)
            ->assertCreated()
            ->assertJsonPath('product.name', 'Desk lamp');

        $productId = $response->json('product.id');
        $this->assertDatabaseHas('products', ['id' => $productId, 'name' => 'Desk lamp']);

        $this->patchJson("/api/products/{$productId}", ['stock' => 5])
            ->assertOk()
            ->assertJsonPath('product.stock', 5);

        $this->deleteJson("/api/products/{$productId}")
            ->assertNoContent();

        $this->assertDatabaseMissing('products', ['id' => $productId]);
    }

    public function test_product_creation_validates_required_fields(): void
    {
        $this->postJson('/api/products', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'category_id', 'price', 'stock', 'is_active']);
    }
}
