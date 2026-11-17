<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;
// Define API routes for the Product resource using the ProductController
Route::apiResource('products', ProductController::class);