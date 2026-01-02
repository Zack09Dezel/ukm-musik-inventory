<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>UKM Musik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">

<div class="relative min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800 overflow-hidden text-white">

    <nav class="relative z-10 container mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center gap-2 text-2xl font-bold">
            Unit Kegiatan Mahasiswa Musik
        </div>
        <div class="flex gap-4">
            <a href="{{ route('login') }}" 
            class="border border-white px-4 py-2 rounded-lg font-semibold 
                    transition duration-300 hover:bg-white hover:text-purple-900">
                Login
            </a>
            <a href="{{ route('register') }}" 
            class="border border-white px-4 py-2 rounded-lg font-semibold 
                    transition duration-300 hover:bg-white hover:text-purple-900">
                Register
            </a>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-24 flex flex-col lg:flex-row items-start">
        <div class="lg:w-full mb-10">
            <h1 class="text-5xl font-bold mb-6 leading-tight">
                Kelola Inventori
                <span class="text-pink-400">Alat Musik</span>
                dengan Mudah
            </h1>
            <p class="text-lg text-gray-200 mb-8">
                Sistem inventori modern untuk UKM Musik. Catat, pantau, dan kelola alat musik dalam satu platform.
            </p>
            <div class="flex gap-4 mb-16">
                <a href="{{ route('register') }}" class="bg-pink-500 px-6 py-3 rounded-lg font-semibold">
                    Mulai Sekarang →
                </a>
                <a href="#fitur" class="border border-white px-6 py-3 rounded-lg">
                    Lihat Fitur
                </a>
            </div>

            <h3 class="text-xl font-semibold mb-4 border-b border-purple-400/50 pb-2 text-center">Inventori Kami</h3>
            
            <div class="grid grid-cols-3 gap-3 w-fit mx-auto">
                
                <div class="rounded-lg shadow-xl overflow-hidden h-50 aspect-square">
                    <img src="{{ asset('images/1.avif') }}" alt="Galeri 1" class="object-cover w-full h-full transition duration-300 hover:scale-110 cursor-pointer"> 
                </div>
                
                <div class="rounded-lg shadow-xl overflow-hidden h-50 aspect-square">
                    <img src="{{ asset('images/2.jpg') }}" alt="Galeri 2" class="object-cover w-full h-full transition duration-300 hover:scale-110 cursor-pointer"> 
                </div>
                
                <div class="rounded-lg shadow-xl overflow-hidden h-50 aspect-square">
                    <img src="{{ asset('images/3.jpg') }}" alt="Galeri 3" class="object-cover w-full h-full transition duration-300 hover:scale-110 cursor-pointer">
                </div>
                
                <div class="rounded-lg shadow-xl overflow-hidden h-50 aspect-square">
                    <img src="{{ asset('images/4.jpg') }}" alt="Galeri 4" class="object-cover w-full h-full transition duration-300 hover:scale-110 cursor-pointer">
                </div>
                
                <div class="rounded-lg shadow-xl overflow-hidden h-50 aspect-square">
                    <img src="{{ asset('images/5.jpg') }}" alt="Galeri 5" class="object-cover w-full h-full transition duration-300 hover:scale-110 cursor-pointer">
                </div>
                
                <div class="rounded-lg shadow-xl overflow-hidden h-50 aspect-square">
                    <img src="{{ asset('images/6.webp') }}" alt="Galeri 6" class="object-cover w-full h-full transition duration-300 hover:scale-110 cursor-pointer">
                </div>
                
                <div class="rounded-lg shadow-xl overflow-hidden h-50 aspect-square">
                    <img src="{{ asset('images/7.webp') }}" alt="Galeri 7" class="object-cover w-full h-full transition duration-300 hover:scale-110 cursor-pointer">
                </div>
                
                <div class="rounded-lg shadow-xl overflow-hidden h-50 aspect-square">
                    <img src="{{ asset('images/8.jpg') }}" alt="Galeri 8" class="object-cover w-full h-full transition duration-300 hover:scale-110 cursor-pointer">
                </div>
                
                <div class="rounded-lg shadow-xl overflow-hidden h-50 aspect-square">
                    <img src="{{ asset('images/9.jpg') }}" alt="Galeri 9" class="object-cover w-full h-full transition duration-300 hover:scale-110 cursor-pointer">
                </div>
            </div>
            </div>
    </div>

<div id="fitur" class="py-20 container mx-auto px-6">
    <h2 class="text-4xl font-bold text-center mb-12">Fitur Unggulan</h2>

    <div class="grid md:grid-cols-3 gap-8">
        <div class="border p-6 rounded-xl">
            <h3 class="text-xl font-bold mb-2">Manajemen Inventori</h3>
            <p>Kelola alat musik lengkap dengan stok dan kondisi.</p>
        </div>

        <div class="border p-6 rounded-xl">
            <h3 class="text-xl font-bold mb-2">Peminjaman</h3>
            <p>Tracking peminjaman dan pengembalian alat musik.</p>
        </div>

        <div class="border p-6 rounded-xl">
            <h3 class="text-xl font-bold mb-2">Role & Akses</h3>
            <p>Hak akses Admin dan User.</p>
        </div>
    </div>
</div>

<h2 class="text-4xl font-bold text-white-900 mb-8 text-center">
    Siap Memulai?
</h2>
    
<div class="flex justify-center pb-20"> 
    <a href="{{ route('register') }}"
       class="inline-block px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg font-semibold text-center">
        Daftar Sekarang
    </a>
</div>

<button id="scrollToTopBtn" 
        class="fixed bottom-8 right-8 bg-purple-600 p-3 rounded-full shadow-lg text-white opacity-0 transition-opacity duration-500 ease-in-out hover:bg-pink-600 z-50">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
</button>
<footer class="bg-gray-900 text-white py-8 text-center">
    © 2024 UKM Musik
</footer>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollBtn = document.getElementById('scrollToTopBtn');
        const scrollThreshold = 200;

        window.addEventListener('scroll', () => {
            if (window.scrollY > scrollThreshold) {
                scrollBtn.classList.remove('opacity-0');
                scrollBtn.classList.add('opacity-100');
                scrollBtn.style.display = 'block';
            } else {
                scrollBtn.classList.remove('opacity-100');
                scrollBtn.classList.add('opacity-0');

                setTimeout(() => {
                     scrollBtn.style.display = 'none';
                }, 500); 
            }
        });

        scrollBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'auto'
            });
        });
        scrollBtn.style.display = 'none';
    });
</script>
</body>
</html>