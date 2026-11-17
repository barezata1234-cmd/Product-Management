<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
// Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'stock',
        'is_active',
    ];
// Define the relationship with the Category model
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}