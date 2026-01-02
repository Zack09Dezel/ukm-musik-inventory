@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 max-w-2xl text-white">
    <div class="mb-8">
        <a href="{{ route('loans.index') }}" class="text-sm text-pink-400 hover:text-white transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Kembali ke Riwayat
        </a>
        <h1 class="text-3xl font-black mt-2">Catat <span class="text-orange-400">Peminjaman</span></h1>
        <p class="text-purple-200/60 text-sm">Pastikan ketersediaan alat musik sebelum mencatat peminjaman baru.</p>
    </div>

    {{-- Alert Error Stok atau Validasi --}}
    @if ($errors->any())
        <div class="bg-rose-500/20 border border-rose-500/50 text-rose-300 p-4 rounded-xl mb-6 text-sm">
            <ul class="list-disc ms-4">
                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
        {{-- Dekorasi Cahaya Oranye --}}
        <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-orange-500/10 blur-[80px]"></div>

        <form action="{{ route('loans.store') }}" method="POST" class="space-y-6 relative z-10">
            @csrf

            {{-- Pilih Barang --}}
            <div>
                <label class="block text-sm font-bold text-purple-200 mb-2">Pilih Alat Musik</label>
                <div class="relative">
                    <select name="item_id" class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none transition appearance-none cursor-pointer">
                        <option value="" class="bg-slate-900">-- Pilih Barang --</option>
                        @foreach($items as $item)
                            {{-- Tambahkan @selected untuk otomatis memilih item dari halaman daftar barang --}}
                            <option value="{{ $item->id }}" class="bg-slate-900" @selected($item->id == ($selected_item_id ?? ''))>
                                {{ $item->name }} — (Tersedia: {{ $item->quantity }})
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-orange-400">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/></svg>
                    </div>
                </div>
            </div>

            {{-- Jumlah --}}
            <div>
                <label class="block text-sm font-bold text-purple-200 mb-2">Jumlah Dipinjam</label>
                <input type="number" name="quantity" value="{{ old('quantity', 1) }}" placeholder="0" min="1"
                       class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none transition text-white">
            </div>

            {{-- Tanggal --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-purple-200 mb-2">Tanggal Pinjam</label>
                    <input type="date" name="borrowed_at" value="{{ old('borrowed_at', date('Y-m-d')) }}"
                           class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none transition text-white [color-scheme:dark]">
                </div>
                <div>
                    <label class="block text-sm font-bold text-purple-200 mb-2">Jatuh Tempo</label>
                    <input type="date" name="due_at" value="{{ old('due_at') }}"
                           class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none transition text-white [color-scheme:dark]">
                </div>
            </div>

            {{-- Catatan --}}
            <div>
                <label class="block text-sm font-bold text-purple-200 mb-2">Catatan Peminjaman (Opsional)</label>
                <textarea name="notes" rows="3" placeholder="Contoh: Digunakan untuk latihan rutin di studio..."
                          class="w-full bg-white/5 border border-white/20 rounded-xl px-4 py-3 focus:ring-2 focus:ring-orange-500 outline-none transition text-white placeholder-white/20">{{ old('notes') }}</textarea>
            </div>

            {{-- Action Button --}}
            <div class="pt-4 flex gap-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-orange-600 to-pink-600 hover:brightness-110 text-white font-black py-4 rounded-2xl shadow-xl transition-all duration-300 transform hover:-translate-y-1 uppercase tracking-widest text-sm">
                    @if(auth()->user()->is_admin)
                        KONFIRMASI PEMINJAMAN
                    @else
                        AJUKAN PEMINJAMAN
                    @endif
                </button>
            </div>
        </form>
    </div>

    {{-- Info Box --}}
    <div class="mt-8 p-4 rounded-2xl bg-orange-500/10 border border-orange-500/20 flex items-start gap-4 backdrop-blur-sm">
        <svg class="w-6 h-6 text-orange-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <p class="text-xs text-orange-200/80 leading-relaxed">
            Sistem akan secara otomatis memvalidasi stok. Jika Anda adalah <strong>User</strong>, permintaan peminjaman akan berstatus <strong>Pending</strong> menunggu persetujuan Admin sebelum stok barang dikurangi.
        </p>
    </div>
</div>
@endsection