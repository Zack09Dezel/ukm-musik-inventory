@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 max-w-2xl text-white">
    <div class="mb-8">
        <a href="{{ route('items.index') }}" class="text-sm text-pink-400 hover:text-white transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"></path></svg>
            Kembali
        </a>
        <h1 class="text-3xl font-black mt-2">Edit <span class="text-pink-400">Data Barang</span></h1>
        <p class="text-purple-200/60 text-sm italic">Memperbarui informasi: {{ $item->name }}</p>
    </div>

    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
        {{-- Efek cahaya di pojok kartu --}}
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-pink-500/20 blur-[80px]"></div>

        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-purple-200 mb-2">Nama Barang</label>
                <input type="text" name="name" value="{{ $item->name }}" 
                       class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-500 outline-none transition">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-purple-200 mb-2">SKU</label>
                    <input type="text" name="sku" value="{{ $item->sku }}" 
                           class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-500 outline-none transition font-mono">
                </div>
                <div>
                    <label class="block text-sm font-bold text-purple-200 mb-2">Stok Tersedia</label>
                    <input type="number" name="quantity" value="{{ $item->quantity }}" 
                           class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-500 outline-none transition">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-purple-200 mb-2">Kondisi</label>
                    <select name="condition" class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-500 outline-none transition appearance-none">
                        <option value="good" @selected($item->condition == 'good' || $item->condition == 'baik') class="bg-slate-900">Baik</option>
                        <option value="repair" @selected($item->condition == 'repair' || $item->condition == 'rusak') class="bg-slate-900">Perlu Perbaikan</option>
                        <option value="broken" @selected($item->condition == 'broken') class="bg-slate-900">Rusak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-purple-200 mb-2">Kategori</label>
                    <select name="category_id" class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-500 outline-none transition appearance-none">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" @selected($item->category_id == $cat->id) class="bg-slate-900">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-purple-200 mb-2">Deskripsi Barang</label>
                <textarea name="description" rows="3" class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-500 outline-none transition">{{ $item->description }}</textarea>
            </div>

            <div class="p-4 bg-black/20 rounded-2xl border border-white/5">
                <label class="block text-sm font-bold text-purple-200 mb-3">Foto Barang</label>
                <div class="flex items-center gap-6">
                    @if($item->image)
                        <div class="text-center">
                            <img src="{{ asset('storage/'.$item->image) }}" class="w-24 h-24 rounded-xl object-cover border-2 border-pink-500/50 shadow-lg shadow-pink-500/20">
                            <span class="text-[10px] text-pink-400 mt-1 block font-bold">Foto Saat Ini</span>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" name="image" class="w-full text-xs text-white/50 file:bg-white/10 file:border-0 file:text-white file:px-4 file:py-2 file:rounded-lg cursor-pointer">
                        <p class="text-[10px] text-white/30 mt-2">*Kosongkan jika tidak ingin mengubah foto</p>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:brightness-110 text-white font-black py-4 rounded-2xl shadow-xl transition-all duration-300">
                UPDATE DATA
            </button>
        </form>
    </div>
</div>
@endsection