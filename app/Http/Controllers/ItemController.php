<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('category');

        // FILTER SEARCH
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('sku', 'like', '%'.$request->search.'%');
            });
        }

        // FILTER CATEGORY
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // PAGINATION
        $items = $query->paginate(10);

        // SEND CATEGORY LIST
        $categories = Category::all();

        return view('items.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:items',
            'quantity' => 'required|integer|min:0',
            'condition' => 'required',
            'description' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        Item::create($data);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan.');
    }


    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:items,sku,' . $item->id,
            'quantity' => 'required|integer|min:0',
            'condition' => 'required',
            'description' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {

            // Hapus gambar lama (jika ada)
            if ($item->image && \Storage::disk('public')->exists($item->image)) {
                \Storage::disk('public')->delete($item->image);
            }

            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($data);

        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui.');
    }


    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus.');
    }
}
