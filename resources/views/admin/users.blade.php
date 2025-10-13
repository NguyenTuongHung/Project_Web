@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="flex min-h-screen bg-green-50">
    <!-- Sidebar -->
    <aside class="w-64 bg-green-700 text-white flex flex-col">
        <div class="p-6 text-center border-b border-green-600">
            <h2 class="text-2xl font-bold">Admin Panel</h2>
        </div>
        <nav class="flex-1 p-4">
            <ul class="space-y-3">
                <li><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-green-600 transition">🏠 Dashboard</a></li>
                <li><a href="{{ route('admin.products') }}" class="block px-4 py-2 rounded hover:bg-green-600 transition">📦 Quản lý sản phẩm</a></li>
                <li><a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 rounded hover:bg-green-600 transition">🛒 Đơn hàng</a></li>
                <li><a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded hover:bg-green-600 transition">👤 Người dùng</a></li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-green-600 transition">🚪 Đăng xuất</button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-8 overflow-auto">
        <h1 class="text-3xl font-bold text-green-900 mb-6">Quản lý người dùng</h1>

        <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Tên</th>
                    <th class="py-2 px-4">Email</th>
                    <th class="py-2 px-4">Số điện thoại</th>
                    <th class="py-2 px-4">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $u->id }}</td>
                    <td class="py-2 px-4">{{ $u->name }}</td>
                    <td class="py-2 px-4">{{ $u->email }}</td>
                    <td class="py-2 px-4">{{ $u->phone }}</td>
                    <td class="py-2 px-4">
                        <button onclick="openUserModal({{ $u->id }}, '{{ addslashes($u->name) }}', '{{ addslashes($u->email) }}', '{{ $u->phone ?? '' }}')" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">✏️ Sửa</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</div>

<!-- Modal chỉnh sửa user -->
<div id="userModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h3 class="text-xl font-bold mb-4">Cập nhật thông tin user</h3>
        <form id="userForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-2">
                <label class="block font-semibold">Tên</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-2">
                <label class="block font-semibold">Email</label>
                <input type="email" name="email" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-2">
                <label class="block font-semibold">Số điện thoại</label>
                <input type="text" name="phone" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeUserModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Đóng</button>
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">Lưu</button>
            </div>
        </form>
    </div>
</div>

<script>
function openUserModal(id,name,email,phone){
    const form = document.getElementById('userForm');
    form.action='/admin/users/'+id;
    form.querySelector('[name="name"]').value=name;
    form.querySelector('[name="email"]').value=email;
    form.querySelector('[name="phone"]').value=phone;
    document.getElementById('userModal').classList.remove('hidden');
    document.getElementById('userModal').classList.add('flex');
}

function closeUserModal(){
    document.getElementById('userModal').classList.add('hidden');
}
</script>
@endsection

