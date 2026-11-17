
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Create the 'products' table with necessary columns
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->string('name');
// Define a foreign key relationship with the 'categories' table
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->cascadeOnDelete()
                  ->cascadeOnUpdate();

            $table->decimal('price', 10, 2);

            $table->integer('stock')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
