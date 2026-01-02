@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 text-white">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-3xl font-black tracking-tight">Daftar <span class="text-pink-400">Barang</span></h1>
        
        {{-- HANYA ADMIN YANG BISA TAMBAH --}}
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('items.create') }}" class="bg-gradient-to-r from-orange-600 to-pink-600 hover:scale-105 transition text-white px-6 py-2.5 rounded-xl font-black shadow-lg">
                + TAMBAH BARANG
            </a>
        @endif
    </div>

    {{-- Alert Error/Success --}}
    @if(session('error'))
        <div class="bg-rose-500/20 border border-rose-500/50 text-rose-400 px-6 py-3 rounded-xl mb-6 tracking-wide italic">
            {{ session('error') }}
        </div>
    @endif

    {{-- Filter Search --}}
    <form method="GET" action="{{ route('items.index') }}" class="mb-8 flex flex-wrap gap-4 bg-white/5 p-4 rounded-2xl border border-white/10 backdrop-blur-md">
        <input type="text" name="search" placeholder="Cari nama atau SKU..." value="{{ request('search') }}" 
               class="bg-white/10 border border-white/20 rounded-xl px-4 py-2 text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-pink-500 flex-1 min-w-[200px]">
        
        <select name="category_id" class="bg-white/10 border border-white/20 rounded-xl px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-pink-500 min-w-[200px]">
            <option value="" class="bg-slate-900 text-white">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id) class="bg-slate-900 text-white">{{ $cat->name }}</option>
            @endforeach
        </select>
        
        <button class="bg-white/10 hover:bg-white/20 border border-white/30 text-white px-6 py-2 rounded-xl font-bold transition">Cari</button>
        <a href="{{ route('items.index') }}" class="text-white/60 hover:text-white flex items-center px-2 transition font-medium text-sm">Reset</a>
    </form>

    <div class="bg-black/30 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 text-purple-200 text-xs uppercase tracking-widest border-b border-white/10">
                        <th class="px-6 py-4">Foto</th>
                        <th class="px-6 py-4">Nama / SKU</th>
                        <th class="px-6 py-4 text-center">Stok</th>
                        <th class="px-6 py-4">Kondisi</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($items as $item)
                    <tr class="hover:bg-white/5 transition duration-150">
                        <td class="px-6 py-4">
                            @if($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}" class="w-12 h-12 rounded-lg object-cover border border-white/20 shadow-md">
                            @else
                                <div class="w-12 h-12 rounded-lg bg-white/5 border border-dashed border-white/20 flex items-center justify-center text-white/20 text-[10px]">NO IMG</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-white">{{ $item->name }}</div>
                            <div class="text-[10px] text-pink-400 tracking-wider font-mono">{{ $item->sku }}</div>
                        </td>
                        <td class="px-6 py-4 text-center font-bold">{{ $item->quantity }}</td>
                        <td class="px-6 py-4 text-sm capitalize">
                            <span class="px-3 py-1 rounded-full bg-white/5 border border-white/10 italic text-[10px]">{{ $item->condition }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-purple-200">{{ $item->category->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                @if(auth()->user()->role === 'admin')
                                    {{-- ADMIN: EDIT & HAPUS --}}
                                    <a href="{{ route('items.edit', $item->id) }}" class="p-2 bg-amber-500/10 hover:bg-amber-500/30 text-amber-400 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline-block">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus?')" class="p-2 bg-rose-500/10 hover:bg-rose-500/30 text-rose-400 rounded-lg transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                @else
                                    {{-- USER: PINJAM --}}
                                    @if($item->quantity > 0)
                                        <a href="{{ route('loans.create', ['item_id' => $item->id]) }}" class="bg-orange-500 hover:bg-orange-600 text-white text-[10px] px-3 py-1.5 rounded-lg font-black uppercase tracking-widest transition shadow-lg">
                                            Pinjam Alat
                                        </a>
                                    @else
                                        <span class="text-white/20 text-[10px] uppercase font-bold italic">Stok Habis</span>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection