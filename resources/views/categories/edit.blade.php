@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 max-w-xl text-white">
    <div class="mb-8">
        <a href="{{ route('categories.index') }}" class="text-sm text-pink-400 hover:text-white transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            Batal & Kembali
        </a>
        <h1 class="text-3xl font-black mt-2 text-white">Edit <span class="text-pink-400">Kategori</span></h1>
        <p class="text-white/40 text-xs mt-1 italic font-mono">ID: #{{ $category->id }}</p>
    </div>

    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
        {{-- Efek cahaya lembut --}}
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-purple-500/20 blur-[50px]"></div>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-bold text-purple-200 mb-3 uppercase tracking-widest text-center md:text-left">Nama Kategori Baru</label>
                <input type="text" name="name" value="{{ $category->name }}" 
                       class="w-full bg-white/10 border border-pink-500/30 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-pink-500 outline-none transition text-lg font-bold text-pink-100">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:brightness-125 text-white font-black py-4 rounded-2xl shadow-xl transition-all duration-300 tracking-widest uppercase">
                UPDATE KATEGORI
            </button>
        </form>
    </div>
</div>
@endsection