<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;
class ProductController extends Controller
{

// return a list of products with optional filtering by category and name products
   public function index(Request $request)
{
    $query = Product::with('category');

    // Filter by category_id 
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }
// Filter by name products
    if ($request->filled('name')) {
        $query->where('name', 'LIKE', '%' . $request->query('name') . '%');
    }

    return response()->json($query->get(), 200);
}
// Store a new product
    public function store(StoreProductRequest $request)
{
    $product = Product::create($request->validated());

    return response()->json([
        'message' => 'Product created successfully',
        'product' => $product
    ], 201);
}
    // Show a specific product
    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json($product, 200);
    }
    // Update a specific product
public function update(UpdateProductRequest $request, $id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json([
            'message' => 'Product not found'
        ], 404);
    }

    $product->update($request->validated());

    return response()->json([
        'message' => 'Product updated successfully',
        'product' => $product
    ], 200);
}
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ], 200);
    }



}
