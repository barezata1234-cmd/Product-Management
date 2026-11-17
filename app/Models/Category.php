<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
// Define the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'description',
    ];
// Define the relationship with the Product model
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}