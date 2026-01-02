<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;

use App\Models\Item;
use App\Models\Category;
use App\Models\Loan;

// 1. HALAMAN DEPAN (Publik)
Route::get('/', function () {
    return view('landing');
});

// 2. DASHBOARD (Admin & User)
Route::get('/dashboard', function () {
    $totalItems = Item::count();
    $totalCategories = Category::count();
    $activeLoans = Loan::where('status', 'borrowed')->count();
    $returnedLoans = Loan::where('status', 'returned')->count();

    return view('dashboard', compact(
        'totalItems',
        'totalCategories',
        'activeLoans',
        'returnedLoans'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. AKSES SEMUA USER TEROTENTIKASI (Admin & User)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // User hanya bisa melihat daftar barang (Index) dan detail (Show)
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');
    
    // Fitur Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Jika ingin User bisa melihat riwayat pinjamannya sendiri:
    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
});

// 4. AKSES KHUSUS ADMIN (CRUD Penuh)
// Proteksi menggunakan middleware 'admin' yang sudah kita buat sebelumnya
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    
    // Admin mengelola Items (Kecuali Index karena sudah ada di atas)
    Route::resource('items', ItemController::class)->except(['index']);
    
    // Admin mengelola Kategori secara penuh
    Route::resource('categories', CategoryController::class);
    
    // Admin mengelola Peminjaman (Approve, Edit, Delete)
    Route::resource('loans', LoanController::class)->except(['index']);
    
    // Admin mengelola User
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';