<?php

namespace App\Http\Controllers;

use App\Models\IncomingItem;
use App\Models\Product;
use Illuminate\Http\Request;

class IncomingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = IncomingItem::with('product')->latest()->get();
        return view('incoming-items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('incoming-items.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // 1️⃣ Validasi form
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity'   => 'required|integer|min:1',
        'date'       => 'required|date',
    ]);

    // 2️⃣ Simpan data barang masuk
    IncomingItem::create([
        'product_id' => $request->product_id,
        'quantity'   => $request->quantity,
        'date'       => $request->date,
    ]);

    // 3️⃣ LOGIKA TAMBAH STOK 🔥
    $product = Product::find($request->product_id);
    $product->increment('stock', $request->quantity);

    // 4️⃣ Redirect
    return redirect()->route('incoming-items.index')
        ->with('success', 'Barang masuk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomingItem $incomingItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IncomingItem $incomingItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncomingItem $incomingItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomingItem $incomingItem)
    {
        //
    }
}
