<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register | UKM Musik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">

<div class="relative min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-xl shadow-2xl transition duration-500 ease-in-out transform hover:scale-105">
        
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-purple-900">
                Daftar Akun UKM Musik
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Akses manajemen inventori alat musik.
            </p>
        </div>

        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 border border-red-300" role="alert">
                <span class="font-bold">Gagal Mendaftar!</span> Terdapat beberapa kesalahan input.
                <ul class="mt-1.5 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="mt-1 block w-full px-3 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm text-gray-900">
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="mt-1 block w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm text-gray-900">
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="mt-1 block w-full px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm text-gray-900">
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="mt-1 block w-full px-3 py-2 border @error('password_confirmation') border-red-500 @else border-gray-300 @enderror rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm text-gray-900">
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-4">
                
                <a href="{{ route('login') }}" class="text-sm font-medium text-purple-600 hover:text-pink-500 transition duration-150">
                    Sudah punya akun?
                </a>
                
                <button type="submit"
                        class="px-5 py-2 border border-transparent text-sm font-medium rounded-md text-white shadow-sm bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-300">
                    Daftar Akun
                </button>
            </div>
        </form>

    </div>
</div>

</body>
</html>