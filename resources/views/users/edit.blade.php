<x-app-layout>

<div class="max-w-3xl mx-auto py-8">

    <h1 class="text-2xl font-bold mb-6">Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-semibold">Nama</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2"
                   value="{{ $user->name }}">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2"
                   value="{{ $user->email }}">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Password (opsional)</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2">
            <small class="text-gray-600">Kosongkan jika tidak ingin mengubah password</small>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Role</label>
            <select name="role" class="w-full border rounded px-3 py-2">
                <option value="user" @if($user->role=='user') selected @endif>User</option>
                <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
            </select>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update
        </button>
    </form>

</div>

</x-app-layout>
