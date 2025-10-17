@extends('layouts.admin')

@section('title', 'Chỉnh sửa người dùng')

@section('content')
<div class="container mx-auto px-6 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">✏️ Chỉnh sửa người dùng</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" 
          class="bg-white shadow-md rounded-lg p-6 max-w-lg mx-auto">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Tên người dùng</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                   class="w-full border px-3 py-2 rounded focus:ring focus:ring-green-200" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                   class="w-full border px-3 py-2 rounded focus:ring focus:ring-green-200" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Mật khẩu mới (nếu đổi)</label>
            <input type="password" name="password" 
                   class="w-full border px-3 py-2 rounded focus:ring focus:ring-green-200">
            <p class="text-sm text-gray-500 mt-1">Để trống nếu không muốn thay đổi mật khẩu.</p>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('admin.users') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Hủy</a>
            <button type="submit" 
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                Cập nhật
            </button>
        </div>
    </form>
</div>
@endsection

