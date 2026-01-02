@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 max-w-xl text-white">
    <div class="mb-8">
        <a href="{{ route('categories.index') }}" class="text-sm text-pink-400 hover:text-white transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            Kembali
        </a>
        <h1 class="text-3xl font-black mt-2">Tambah <span class="text-pink-400">Kategori</span></h1>
    </div>

    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-purple-200 mb-3 uppercase tracking-widest">Nama Kategori</label>
                <input type="text" name="name" autofocus placeholder="Misal: Alat Tiup, Perkusi..." 
                       class="w-full bg-white/5 border border-white/20 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-pink-500 outline-none transition text-lg font-medium placeholder-white/20">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:scale-[1.02] active:scale-95 text-white font-black py-4 rounded-2xl shadow-xl transition-all duration-300 tracking-[0.1em]">
                SIMPAN KATEGORI
            </button>
        </form>
    </div>
</div>
@endsection