<x-app-layout>
    <div class="max-w-3xl mx-auto py-6">

        <h1 class="text-2xl font-bold mb-6">Tambah User</h1>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Nama</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-medium">Email</label>
                <input type="email" name="email" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-medium">Password</label>
                <input type="password" name="password" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block font-medium">Role</label>
                <select name="role" class="w-full border rounded p-2">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan
            </button>
        </form>

    </div>
</x-app-layout>
