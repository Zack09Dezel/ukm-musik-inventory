<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password | UKM Musik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">

<div class="relative min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-md w-full space-y-6 p-10 bg-white rounded-xl shadow-2xl transition duration-500 ease-in-out transform hover:scale-105">
        
        <div class="text-center">
            <h2 class="mt-2 text-3xl font-extrabold text-purple-900">
                Lupa Password?
            </h2>
        </div>
        
        <div class="text-sm text-gray-700">
            Lupa password Anda? Tenang saja. Cukup berikan alamat email Anda dan kami akan mengirimkan tautan reset password yang memungkinkan Anda memilih password baru.
        </div>

        <form class="mt-4 space-y-6" method="POST" action="{{ route('password.email') }}">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 sm:text-sm text-gray-900">
                </div>

            <div class="flex items-center justify-end pt-4">
                <button type="submit"
                        class="px-5 py-2 border border-transparent text-sm font-medium rounded-md text-white shadow-sm bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-300">
                    Kirim Tautan Reset Password
                </button>
            </div>
            
            <div class="text-center pt-2">
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-purple-600 transition duration-150">
                    Kembali ke halaman Login
                </a>
            </div>
        </form>

    </div>
</div>

</body>
</html>