<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get All Products
        $products = Product::all();

        //Return View
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validation Form
        $request->validate([
            'code' => 'required|unique:products',
            'name' => 'required',
        ]);

        //Create Product
        Product::create([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        //Redirect to Product List
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //Validation Form
        $request->validate([
            'code' => 'required|unique:products,code,'.$product->id,
            'name' => 'required',
        ]);

        //Update Product
        $product->update([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        //Redirect to Product List
        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //Delete Product
        $product->delete();

        //Redirect to Product List
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}
