<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $links = [
          "/products/create" => "Create",
        ];

        return view('products.index', compact('products', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'proteins' => ['required', 'lte:100'],
            'fats' => ['required', 'lte:100'],
            'carbs' => ['required', 'lte:100'],
        ]);

        Product::create($attributes);

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $links = [
            "/products" => "All products",
            "/products/create" => "Create",
            "/products/$product->id" => "Edit",
            "/products/$product->id" => "Delete",
        ];

        return view('products.show', compact('product', 'links'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product)
    {
        $attributes = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'proteins' => ['required', 'lte:100'],
            'fats' => ['required', 'lte:100'],
            'carbs' => ['required', 'lte:100'],
        ]);

        $product->update($attributes);

        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/products');
    }
}
