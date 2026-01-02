<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | UKM Musik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">

<div class="relative min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-md w-full space-y-8 p-10 bg-white rounded-xl shadow-2xl transition duration-500 ease-in-out transform hover:scale-105">
        
        <div class="text-center">
            <h2 class="mt-6 text-3xl font-extrabold text-purple-900">
                Masuk ke UKM Musik
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Gunakan akun Anda untuk mengakses dashboard inventori.
            </p>
        </div>

        @error('email')
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 border border-red-300" role="alert">
            <span class="font-bold">Gagal Masuk!</span> {{ $message }}
        </div>
        @enderror
        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm text-gray-900">
            </div>

            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm text-gray-900">
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="h-4 w-4 text-pink-600 border-gray-300 rounded focus:ring-pink-500">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                        Ingat Saya
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       class="text-sm font-medium text-purple-600 hover:text-pink-500 transition duration-150">
                        Lupa Password?
                    </a>
                @endif

                <button type="submit"
                        class="ms-4 px-5 py-2 border border-transparent text-sm font-medium rounded-md text-white shadow-sm bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-300">
                    Masuk
                </button>
            </div>
            
            <div class="text-center pt-4">
                <a href="{{ route('register') }}" class="text-sm font-medium text-gray-600 hover:text-purple-600 transition duration-150">
                    Belum punya akun? Daftar di sini.
                </a>
            </div>
        </form>

    </div>
</div>

</body>
</html>