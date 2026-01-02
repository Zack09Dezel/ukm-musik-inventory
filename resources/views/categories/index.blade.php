@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 text-white">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 text-center md:text-left">
        <div>
            <h1 class="text-3xl font-black tracking-tight">Data <span class="text-pink-400">Kategori</span></h1>
        </div>
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('categories.create') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:brightness-110 text-white px-6 py-3 rounded-2xl font-black shadow-lg transition">
            + KATEGORI BARU
        </a>
        @endif
    </div>

    <div class="bg-black/30 backdrop-blur-xl border border-white/10 rounded-[2rem] overflow-hidden shadow-2xl max-w-4xl">
        <table class="w-full text-left">
            <thead>
                <tr class="text-purple-200 text-[10px] uppercase tracking-[0.2em] font-black border-b border-white/5 bg-white/5">
                    <th class="px-8 py-5">Nama Kategori</th>
                    <th class="px-8 py-5 text-right">Opsi Manajemen</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($categories as $category)
                <tr class="hover:bg-white/5 transition-colors">
                    <td class="px-8 py-5 font-bold uppercase tracking-wide text-white">{{ $category->name }}</td>
                    <td class="px-8 py-5 text-right">
                        @if(auth()->user()->role === 'admin')
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-amber-400/50 hover:text-amber-400 transition p-2 bg-white/5 rounded-lg border border-white/10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-width="2" stroke-linecap="round"></path></svg>
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus?')" class="text-rose-500/50 hover:text-rose-500 transition p-2 bg-white/5 rounded-lg border border-white/10">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2" stroke-linecap="round"></path></svg>
                                </button>
                            </form>
                        </div>
                        @else
                            <span class="text-white/10 text-[10px] uppercase font-bold tracking-widest italic">Restricted</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection