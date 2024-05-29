<?php

namespace App\Http\Controllers;

// Import model Stock

use App\Models\Stock; 

// Import return type View
use Illuminate\View\View;

// Import return type RedirectResponse
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

// Import Facades Storage
use Illuminate\Support\Facades\Storage;

class StockController extends Controller
{
    public function index(): View
    {
        // Geelanggans = Stock::latest()->paginate(10);

        // Render viewelanggans
        $stocks = Stock::latest()->paginate(10);
        return view('stocks.index', compact('stocks'));
    }

    public function create(): View
    {
        return view('stocks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'nama_produk'       => 'required|string|min:1',
            'kategori'          => 'required|string|min:1',
            'size'              => 'required|string|min:1',
            'jumlah_stok'       => 'required|string|min:1',
        ]);

        // Upload image (jika ada)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/stocks', $image->hashName());
            $imageName = $image->hashName();
        } else {
            $imageName = null;
        }

        // Buat produk
        Stock::create([
            'nama_produk'      => $request->nama_produk,
            'kategori'         => $request->kategori,
            'size'             => $request->size,
            'jumlah_stock'     => $request->jumlah_stock,
            
        ]);

        // Redirect ke halaman index
        return redirect()->route('stocks.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        // Get Stock by ID
        $stock = Stock::findOrFail($id);

        // Render view with stock
        return view('stocks.show', compact('stock'));
    }

    public function edit(string $id): View
    {
        // Get Stock by ID
        $stock = Stock::findOrFail($id);

        // Render view with Stock
        return view('stocks.edit', compact('stock'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'nama_produk'       => 'required|string|min:1',
            'kategori'          => 'required|string|min:1',
            'size'              =>'required|string|min:1',
            'jumlah_stok'       => 'required|string|min:1',
        ]);

        // Get product by ID
        $stock = Stock::findOrFail($id);

        // Check if image is uploaded
        if ($request->hasFile('image')) {
            // Upload new image
            $image = $request->file('image');
            $image->storeAs('public/stocks', $image->hashName());

            // Delete old image
            Storage::delete('public/stocks/' . $stock->image);

            // Update Stock with new image
            $stock->update([
                'nama_produk'      => $request->nama_produk,
                'kategori'         => $request->kategori,
                'size'             => $request->size,
                'jumlah_stock'     => $request->jumlah_stock,
            ]);
        } else {
            // Update Stock without image
            $stock->update([
                'nama_produk'      => $request->nama_produk,
                'kategori'         => $request->kategori,
                'size'             => $request->size,
                'jumlah_stock'     => $request->jumlah_stock,
            ]);
        }

        // Redirect to index
        return redirect()->route('stocks.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id): RedirectResponse
    {
        // Get Stock by ID
        $stock = Stock::findOrFail($id);

        // Delete image
        Storage::delete('public/stocks/' . $stock->image);

        // Delete Stock
        $stock->delete();

        // Redirect to index
        return redirect()->route('stocks.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}