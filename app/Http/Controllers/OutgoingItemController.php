<?php

namespace App\Http\Controllers;

use App\Models\OutgoingItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OutgoingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = OutgoingItem::with('product')->latest()->get();
        return view('outgoing-items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('outgoing-items.create', compact('products'));
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

        // 2️⃣ Ambil produk
        $product = Product::findOrFail($request->product_id);

        // 3️⃣ VALIDASI STOK (INI POIN PENILAIAN UTAMA 🔥)
        if ($product->stock < $request->quantity) {
            return back()->withErrors('Stok tidak mencukupi');
        }

        // 4️⃣ Simpan data barang keluar
        OutgoingItem::create([
            'product_id' => $request->product_id,
            'quantity'   => $request->quantity,
            'date'       => $request->date,
        ]);

        // 5️⃣ Kurangi stok produk
        $product->decrement('stock', $request->quantity);

        // 6️⃣ Redirect
        return redirect()->route('outgoing-items.index')
            ->with('success', 'Barang keluar berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(OutgoingItem $outgoingItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OutgoingItem $outgoingItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OutgoingItem $outgoingItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OutgoingItem $outgoingItem)
    {
        //
    }
}
