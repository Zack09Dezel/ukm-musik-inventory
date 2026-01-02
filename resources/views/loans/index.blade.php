@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 text-white">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-black tracking-tight uppercase">Riwayat <span class="text-orange-400">Peminjaman</span></h1>
            <p class="text-purple-200/60 text-sm">Status peminjaman inventori UKM Musik.</p>
        </div>
        
        {{-- Tombol catat pinjam manual untuk Admin --}}
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('loans.create') }}" class="bg-gradient-to-r from-orange-600 to-pink-600 hover:scale-105 transition text-white px-6 py-2.5 rounded-xl font-black shadow-lg">
            + CATAT PINJAM BARU
        </a>
        @endif
    </div>

    <div class="bg-black/30 backdrop-blur-xl border border-white/10 rounded-[2rem] overflow-hidden shadow-2xl">
        <div class="overflow-x-auto p-2">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-purple-200 text-[10px] uppercase tracking-[0.2em] font-black border-b border-white/5">
                        <th class="px-6 py-5 text-center italic">Barang</th>
                        <th class="px-6 py-5">Peminjam</th>
                        <th class="px-6 py-5">Tgl Kembali</th>
                        <th class="px-6 py-5 text-center">Status</th>
                        <th class="px-6 py-5 text-right">Manajemen</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($loans as $loan)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-5 font-black">{{ $loan->item->name }}</td>
                        <td class="px-6 py-5 text-purple-100 text-sm font-bold">{{ $loan->user->name }}</td>
                        <td class="px-6 py-5 text-white/50 text-[10px] font-mono">{{ $loan->due_at }}</td>
                        <td class="px-6 py-5 text-center">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-amber-500/10 text-amber-500 border-amber-500/30',
                                    'borrowed' => 'bg-orange-500/10 text-orange-400 border-orange-500/30',
                                    'returned' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/30',
                                ];
                                $c = $statusClasses[$loan->status] ?? 'bg-white/5 text-white/50 border-white/10';
                            @endphp
                            <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $c }}">
                                {{ $loan->status }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex justify-end gap-2">
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('loans.edit', $loan->id) }}" class="p-2.5 bg-white/5 hover:bg-orange-500/20 text-white/50 hover:text-orange-400 rounded-xl transition-all border border-white/5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Hapus?')" class="p-2.5 bg-white/5 hover:bg-rose-500/20 text-white/50 hover:text-rose-400 rounded-xl transition-all border border-white/5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-white/10 text-[10px] italic px-4 uppercase font-bold tracking-widest">Fixed Data</span>
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