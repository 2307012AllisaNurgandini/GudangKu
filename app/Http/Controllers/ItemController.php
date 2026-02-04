<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;

class ItemController extends Controller
{
    public function index(Request $request)
{
    $query = Item::query();

    // 1. Filter Tanggal
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    // 2. Filter Pencarian (DIBERIKAN GROUPING AGAR TIDAK BENTROK DENGAN TANGGAL)
    if ($request->filled('search')) {
        $search = $request->search;
        // Tambahkan 'use ($search)' agar variabel bisa terbaca di dalam function
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('category', 'like', '%' . $search . '%');
        });
    }

    // Urutkan berdasarkan yang terbaru
    $items = $query->orderBy('created_at', 'desc')->get();

    return view('items.index', compact('items'));
}

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        Item::create($request->all());
        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function print(Request $request)
{
    // Ambil data yang sama dengan index (termasuk hasil search jika ada)
    $query = Item::query();
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('category', 'like', "%{$search}%");
        });
    }
    $items = $query->orderBy('created_at', 'desc')->get();

    // Load view index, tapi tambahkan variabel 'isPrinting'
    $pdf = Pdf::loadView('items.index', [
        'items' => $items,
        'isPrinting' => true 
    ]);

    return $pdf->download('daftar-barang.pdf');
}

public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $item->update($request->all());
        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus!');
    }
}
