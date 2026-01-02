@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 max-w-2xl text-white">
    <div class="mb-8">
        <a href="{{ route('loans.index') }}" class="text-sm text-pink-400 hover:text-white transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-black mt-2">Edit <span class="text-orange-400">Peminjaman</span></h1>
        <p class="text-purple-200/60 text-sm italic">Memperbarui catatan peminjaman untuk: {{ $loan->user->name }}</p>
    </div>

    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl relative">
        <form action="{{ route('loans.update', $loan->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Barang --}}
            <div>
                <label class="block text-sm font-bold text-purple-200 mb-2">Barang yang Dipinjam</label>
                <select name="item_id" class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none transition appearance-none cursor-pointer">
                    @foreach($items as $item)
                        <option value="{{ $item->id }}" @selected($loan->item_id == $item->id) class="bg-slate-900">
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Jumlah & Status --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-purple-200 mb-2">Jumlah</label>
                    <input type="number" name="quantity" value="{{ $loan->quantity }}" 
                           class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-purple-200 mb-2">Status Peminjaman</label>
                    <select name="status" class="w-full bg-white/10 border border-orange-500/50 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none transition appearance-none cursor-pointer font-bold text-orange-400">
                        <option value="pending" @selected($loan->status == 'pending') class="bg-slate-900 text-amber-400">🟡 Menunggu (Pending)</option>
                        <option value="approved" @selected($loan->status == 'approved') class="bg-slate-900 text-blue-400">🔵 Disetujui (Approved)</option>
                        <option value="borrowed" @selected($loan->status == 'borrowed') class="bg-slate-900 text-orange-400">🟠 Dipinjam (Borrowed)</option>
                        <option value="returned" @selected($loan->status == 'returned') class="bg-slate-900 text-emerald-400">🟢 Dikembalikan (Returned)</option>
                    </select>
                </div>
            </div>

            {{-- Tanggal-tanggal --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-black/20 rounded-2xl border border-white/5">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-purple-300 mb-2">Tgl Pinjam</label>
                    <input type="date" name="borrowed_at" value="{{ $loan->borrowed_at }}" 
                           class="w-full bg-white/5 border border-white/10 rounded-lg px-2 py-2 text-xs focus:ring-1 focus:ring-orange-500 outline-none [color-scheme:dark]">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-purple-300 mb-2">Jatuh Tempo</label>
                    <input type="date" name="due_at" value="{{ $loan->due_at }}" 
                           class="w-full bg-white/5 border border-white/10 rounded-lg px-2 py-2 text-xs focus:ring-1 focus:ring-orange-500 outline-none [color-scheme:dark]">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-emerald-400 mb-2">Tgl Kembali</label>
                    <input type="date" name="returned_at" value="{{ $loan->returned_at }}" 
                           class="w-full bg-white/5 border border-emerald-500/20 rounded-lg px-2 py-2 text-xs focus:ring-1 focus:ring-emerald-500 outline-none [color-scheme:dark]">
                </div>
            </div>

            {{-- Catatan --}}
            <div>
                <label class="block text-sm font-bold text-purple-200 mb-2">Catatan</label>
                <textarea name="notes" rows="3" class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none transition placeholder-white/20">{{ $loan->notes }}</textarea>
            </div>

            {{-- Submit --}}
            <button type="submit" class="w-full bg-gradient-to-r from-orange-600 to-pink-600 hover:brightness-110 text-white font-black py-4 rounded-2xl shadow-xl transition-all duration-300 transform hover:-translate-y-1 tracking-widest uppercase text-sm">
                Update Data Peminjaman
            </button>
        </form>
    </div>
</div>
@endsection