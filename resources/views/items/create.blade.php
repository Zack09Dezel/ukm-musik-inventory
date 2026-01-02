@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 max-w-2xl text-white">
    <div class="mb-8 text-center md:text-left">
        <a href="{{ route('items.index') }}" class="text-sm text-pink-400 hover:text-white transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-black mt-2">Tambah <span class="text-pink-400">Barang Baru</span></h1>
        <p class="text-purple-200/60 text-sm">Masukkan detail alat musik untuk menambah stok inventori.</p>
    </div>

    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl">
        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="bg-rose-500/20 border border-rose-500/50 text-rose-300 p-4 rounded-xl mb-6 text-sm">
                <ul class="list-disc ms-4">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-purple-200 mb-2">Nama Barang</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Gitar Elektrik" 
                           class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-purple-200 mb-2">SKU (Kode Unit)</label>
                    <input type="text" name="sku" value="{{ old('sku') }}" placeholder="UKM-GTR-001" 
                           class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-500 outline-none transition font-mono uppercase">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-purple-200 mb-2">Jumlah Awal</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" 
                           class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-purple-200 mb-2">Kondisi</label>
                    <select name="condition" class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-500 outline-none transition appearance-none">
                        <option value="baik" class="bg-slate-900">Baik</option>
                        <option value="rusak" class="bg-slate-900">Rusak</option>
                        <option value="hilang" class="bg-slate-900">Hilang</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-purple-200 mb-2">Kategori</label>
                <select name="category_id" class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-pink-500 outline-none transition appearance-none">
                    <option value="" class="bg-slate-900">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id) class="bg-slate-900">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-purple-200 mb-2">Unggah Foto</label>
                <div class="relative group">
                    <input type="file" name="image" class="w-full cursor-pointer bg-white/5 border-2 border-dashed border-white/20 rounded-2xl p-6 text-sm text-white/40 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-pink-600 file:text-white hover:file:bg-pink-500 transition">
                </div>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-pink-600 to-purple-600 hover:brightness-110 text-white font-black py-4 rounded-2xl shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                SIMPAN BARANG
            </button>
        </form>
    </div>
</div>
@endsection