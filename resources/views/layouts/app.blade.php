<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Menghilangkan gaya default bootstrap yang tabrakan */
        .card { background: transparent; border: none; }
        .table { color: white !important; border-color: rgba(255,255,255,0.1) !important; }
    </style>
</head>
<body class="font-sans antialiased text-white">
    <div class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800">
        
        {{-- Navbar Transparan --}}
        <nav class="bg-black/20 backdrop-blur-lg border-b border-white/10 shadow-lg">
            @include('layouts.navigation')
        </nav>

        {{-- Page Header (Optional) --}}
        @hasSection('header')
            <header class="bg-white/5 backdrop-blur-sm shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif

        {{-- Page Content --}}
        <main class="py-10">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>