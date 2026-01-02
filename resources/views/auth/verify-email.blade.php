<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email | UKM Musik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">

<div class="relative min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-800 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-md w-full space-y-6 p-10 bg-white rounded-xl shadow-2xl">
        
        <div class="text-center">
            <h2 class="mt-2 text-3xl font-extrabold text-purple-900">
                Verifikasi Alamat Email Anda
            </h2>
        </div>
        
        <div class="text-sm text-gray-700">
            Terima kasih telah mendaftar! Sebelum melanjutkan, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda. Jika Anda tidak menerima email tersebut, kami akan dengan senang hati mengirimkannya lagi.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="p-4 font-medium text-sm text-green-800 rounded-lg bg-green-100 border border-green-300" role="alert">
                <span class="font-bold">Terkirim!</span> Tautan verifikasi baru telah dikirimkan ke alamat email Anda.
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                        class="px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white shadow-sm bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-300">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="underline text-sm text-gray-600 hover:text-purple-600 transition duration-150 p-2">
                    Keluar (Log Out)
                </button>
            </form>
        </div>

    </div>
</div>

</body>
</html>