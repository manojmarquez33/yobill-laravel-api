<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    //

    public function index()
    {
        $products = Product::latest()->paginate(10);
        return response()->json($products);

    }

    public function create()
    {
        return response()->json(['message' => 'Create form not applicable for API']);
    }

    public function store(Request $request)
    {

        $validateData = $request->validate(
            [
                'product_name' => 'required|max:255',
                'product_id' => 'required|unique:products',
                'product_image' => 'required|string|max:100',
                'product_description' => 'required|string|max:255',
                'product_price' => 'required|numeric|max:100',
                'product_stock' => 'required|numeric|max:100'
            ]
        );

        $product = Product::create($validateData);

        return response()->json($product);

    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function edit(Product $product)
    {
        return response()->json();
    }

    public function update(Request $request,Product $product)
    {
        $validateData = $request->validate(
            [
                'product_name' => 'required|max:255',
                'product_id' => 'required|unique:products',
                'product_image' => 'required|string|max:100',
                'product_description' => 'required|string|max:255',
                'product_price' => 'required|numeric|max:100',
                'product_stock' => 'required|numeric|max:100'
            ]
        );

        $product->update($validateData);

        return response()->json($product);
    }

    public function destroy(Product $product){
        $product->delete();
        return response()->json(null);
    }




public function serveImage($filename)
{
    $path = storage_path('app/private/products/' . $filename);

    if (!file_exists($path)) {
        return response()->json(['error' => 'Image not found'], 404);
    }

    return response()->file($path);
}

}
