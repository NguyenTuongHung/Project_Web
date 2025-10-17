@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="container mx-auto px-6 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">👥 Quản lý người dùng</h2>

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Bảng danh sách --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Tên</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Ngày tạo</th>
                    <th class="px-4 py-2 text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-2">{{ $user->id }}</td>
                        <td class="px-4 py-2 font-medium">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('admin.users.edit', $user->id) }}" 
                               class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded mr-2">
                                ✏️ Sửa
                            </a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    onclick="return confirm('Bạn có chắc muốn xóa người dùng này?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                    🗑️ Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">Chưa có người dùng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


