<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

/**
 * Class ProductsController
 * @package App\Http\Controllers
 */
class ProductsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::all();
        $links = [
          "/" => "Home",
          "/products/create" => "Create",
        ];

        return view('products.index', compact('products', 'links'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $attributes = $this->validateProduct();

        Product::create($attributes);

        return redirect('/products');
    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Product $product)
    {
        $attributes = $this->validateProduct();

        $product->update($attributes);

        return redirect('/products');
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/products');
    }

    /**
     * @return mixed
     */
    public function validateProduct()
    {
        return request()->validate([
            'name' => ['required', 'max:255'],
            'proteins' => ['required', 'lte:100'],
            'fats' => ['required', 'lte:100'],
            'carbs' => ['required', 'lte:100'],
        ]);
    }
}
