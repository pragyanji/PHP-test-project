<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SaleController extends Controller
{
    /**
     * Display a listing of sales history.
     */
    public function index(Request $request): View
    {
        $sales = Sale::with('product')->orderBy('id', 'desc')->paginate(10);

        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new sale record.
     */
    public function create(): View
    {
        // Fetch all products that have stock available to sell
        $products = Product::where('quantity', '>', 0)->orderBy('name', 'asc')->get();

        return view('sales.create', compact('products'));
    }

    /**
     * Store a newly created sale record in storage and update product stock.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->quantity < $validated['quantity']) {
            return back()
                ->withErrors(['quantity' => "The selected product only has {$product->quantity} items in stock."])
                ->withInput();
        }

        DB::transaction(function () use ($product, $validated) {
            // Decrement product quantity
            $product->decrement('quantity', $validated['quantity']);

            // Record the sale
            Sale::create([
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
                'price_at_sale' => $product->price,
                'total_price' => $product->price * $validated['quantity'],
            ]);
        });

        return redirect()->route('sales.index')->with('success', 'Sale transaction completed successfully.');
    }
}
