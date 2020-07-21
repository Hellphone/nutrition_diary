<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Validation\Rule;
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
        $products = Product::where('owner_id', 'like', auth()->id())->get();
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
        $attributes['owner_id'] = auth()->id();

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
        $this->authorize('update', $product);

        return view('products.edit', compact('product'));
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Product $product)
    {
        $product->update($this->validateProduct());

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
     * @param Product $product
     * @return mixed
     */
    public function validateProduct()
    {
        return request()->validate([
            'name' => [
                'required',
                Rule::unique('products')->ignore(request('id')),
                'max:255'
            ],
            'proteins' => ['required', 'gte:0', 'lte:100'],
            'fats' => ['required', 'gte:0', 'lte:100'],
            'carbs' => ['required', 'gte:0', 'lte:100'],
        ]);
    }
}
