@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-4">
        <div>
            <h1 class="text-4xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-pink-300 to-purple-300">
                Dashboard Inventori
            </h1>
            <p class="text-purple-200 mt-2 text-lg">Selamat datang kembali! Kelola alat musik dengan mudah.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-3xl hover:bg-white/20 transition-all duration-300 group shadow-xl">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-indigo-500/20 rounded-2xl group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <span class="text-xs font-black text-indigo-300 uppercase tracking-widest">Total Barang</span>
            </div>
            <h3 class="text-4xl font-black text-white">{{ $totalItems }}</h3>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-3xl hover:bg-white/20 transition-all duration-300 group shadow-xl">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-purple-500/20 rounded-2xl group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                </div>
                <span class="text-xs font-black text-purple-300 uppercase tracking-widest">Kategori</span>
            </div>
            <h3 class="text-4xl font-black text-white">{{ $totalCategories }}</h3>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-3xl hover:bg-white/20 transition-all duration-300 group shadow-xl border-l-4 border-l-orange-500">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-orange-500/20 rounded-2xl group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-black text-orange-300 uppercase tracking-widest">Dipinjam</span>
            </div>
            <h3 class="text-4xl font-black text-white">{{ $activeLoans }}</h3>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-6 rounded-3xl hover:bg-white/20 transition-all duration-300 group shadow-xl border-l-4 border-l-emerald-500">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-emerald-500/20 rounded-2xl group-hover:scale-110 transition">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-xs font-black text-emerald-300 uppercase tracking-widest">Selesai</span>
            </div>
            <h3 class="text-4xl font-black text-white">{{ $returnedLoans }}</h3>
        </div>
    </div>

    <div class="bg-black/30 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden shadow-2xl">
        <div class="px-8 py-6 border-b border-white/10 flex justify-between items-center bg-white/5">
            <h3 class="text-xl font-bold">Peminjaman Terbaru</h3>
            <a href="#" class="text-sm font-bold text-pink-400 hover:text-pink-300 transition">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto p-4">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-purple-200 text-sm uppercase tracking-widest border-b border-white/10">
                        <th class="px-6 py-4">Barang</th>
                        <th class="px-6 py-4">Peminjam</th>
                        <th class="px-6 py-4">Tgl Pinjam</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach(\App\Models\Loan::latest()->take(5)->get() as $loan)
                    <tr class="hover:bg-white/5 transition duration-150">
                        <td class="px-6 py-4 font-semibold text-white">{{ $loan->item->name }}</td>
                        <td class="px-6 py-4 text-purple-100">{{ $loan->user->name }}</td>
                        <td class="px-6 py-4 text-white/50 text-sm">{{ $loan->borrowed_at }}</td>
                        <td class="px-6 py-4">
                            <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter border 
                                {{ $loan->status == 'active' ? 'bg-orange-500/20 text-orange-400 border-orange-500/30' : 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30' }}">
                                {{ $loan->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection