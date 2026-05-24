<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    public function product_details(Request $request)
    {
        $query = Product::orderBy("id", "desc");

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        $products = $query->paginate(10)->withQueryString();

        return view('products.product_details', compact('products'));
    }

    // public function create(Request $request)
    // {
    //     return view("products.create");
    // }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0'
            ]);
            
            Product::create($validatedData);
            
            return redirect()->route('products.product_details')->with('success', 'Product created successfully.');
            }
            
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
        }

    public function update(Request $request, Product $product)
    {        $pro = request()->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0'
        ]);
        // update the model and redirect back to the index with a success message
        $product->update($pro);

        return redirect()->route('products.product_details')->with('success', 'Product updated successfully.');
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect()->route('products.product_details')->with(key: 'success', value: 'Product deleted successfully.');
    }
}
