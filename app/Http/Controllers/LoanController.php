<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        // USER HANYA LIHAT PUNYA SENDIRI, ADMIN LIHAT SEMUA
        if (Auth::user()->is_admin) {
            $loans = Loan::with(['item', 'user'])->latest()->paginate(10);
        } else {
            $loans = Loan::where('user_id', Auth::id())->with(['item', 'user'])->latest()->paginate(10);
        }
        
        return view('loans.index', compact('loans'));
    }

    public function create(Request $request)
    {
        $items = Item::where('quantity', '>', 0)->get();
        
        // MENANGKAP PARAMETER ITEM_ID DARI HALAMAN DAFTAR BARANG
        $selected_item_id = $request->query('item_id'); 
        
        return view('loans.create', compact('items', 'selected_item_id'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'borrowed_at' => 'required|date',
            'due_at' => 'required|date|after_or_equal:borrowed_at',
            'notes' => 'nullable',
        ]);

        // CEK STOK TERLEBIH DAHULU SEBELUM PROSES
        $item = Item::findOrFail($data['item_id']);
        if ($item->quantity < $data['quantity']) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi. Tersisa: ' . $item->quantity]);
        }

        $data['user_id'] = Auth::id();
        
        // JIKA ADMIN YANG INPUT, STATUS LANGSUNG 'BORROWED'
        // JIKA USER YANG INPUT, STATUS 'PENDING' (UNTUK DISETUJUI ADMIN)
        $data['status'] = Auth::user()->is_admin ? 'borrowed' : 'pending';

        Loan::create($data);

        // HANYA KURANGI STOK JIKA STATUSNYA LANGSUNG 'BORROWED'
        if ($data['status'] === 'borrowed') {
            $item->decrement('quantity', $data['quantity']);
        }

        return redirect()->route('loans.index')->with('success', 'Permintaan peminjaman berhasil dikirim.');
    }

    public function edit(Loan $loan)
    {
        // KEAMANAN: USER BIASA TIDAK BOLEH EDIT DATA PINJAMAN
        if (!Auth::user()->is_admin) {
            abort(403, 'Hanya Admin yang dapat mengedit status peminjaman.');
        }

        $items = Item::all();
        return view('loans.edit', compact('loan', 'items'));
    }

    public function update(Request $request, Loan $loan)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $data = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'borrowed_at' => 'required|date',
            'due_at' => 'required|date',
            'returned_at' => 'nullable|date',
            'status' => 'required|in:pending,approved,borrowed,returned',
            'notes' => 'nullable',
        ]);

        $item = Item::findOrFail($data['item_id']);

        // LOGIKA PENGEMBALIAN STOK OTOMATIS
        // Jika status berubah menjadi 'returned' dan sebelumnya bukan 'returned'
        if ($data['status'] === 'returned' && $loan->status !== 'returned') {
            $item->increment('quantity', $loan->quantity);
        } 
        
        // JIKA STATUS BERUBAH DARI PENDING KE BORROWED/APPROVED (KURANGI STOK)
        if (($data['status'] === 'borrowed' || $data['status'] === 'approved') && $loan->status === 'pending') {
            if ($item->quantity < $loan->quantity) {
                return back()->withErrors(['status' => 'Gagal menyetujui, stok barang tidak mencukupi.']);
            }
            $item->decrement('quantity', $loan->quantity);
        }

        $loan->update($data);

        return redirect()->route('loans.index')->with('success', 'Status peminjaman diperbarui.');
    }

    public function destroy(Loan $loan)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        // Jika data dihapus saat status masih 'borrowed', kembalikan stoknya dulu
        if ($loan->status === 'borrowed' || $loan->status === 'approved') {
            $loan->item->increment('quantity', $loan->quantity);
        }

        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Data berhasil dihapus.');
    }
}