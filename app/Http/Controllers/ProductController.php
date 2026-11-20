<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function productAll()
    {
        $products = Product::orderBy('id', 'asc')->get();

        return response()->json(['products' => $products]);
    }

    public function productGet(Product $product)
    {
        return response()->json(['product' => $product]);
    }

    public function productAdd(StoreProductRequest $request)
    {
        $product = new Product;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->unit = $request->unit;
        $product->standard_cost = $request->standard_cost;
        $product->save();

        return response()->json(['product' => $product], 201);
    }

    public function productEdit(UpdateProductRequest $request, Product $product)
    {
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->unit = $request->unit;
        $product->standard_cost = $request->standard_cost;
        $product->save();

        return response()->json(['product' => $product]);
    }

    public function productDelete(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'deleted']);
    }
}
