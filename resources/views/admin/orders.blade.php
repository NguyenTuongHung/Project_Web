@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

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
        <h1 class="text-3xl font-bold text-green-900 mb-6">Quản lý đơn hàng</h1>

        <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
            <thead class="bg-green-700 text-white">
                <tr>
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Người đặt</th>
                    <th class="py-2 px-4">Sản phẩm</th>
                    <th class="py-2 px-4">Tổng tiền</th>
                    <th class="py-2 px-4">Trạng thái</th>
                    <th class="py-2 px-4">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $o)
                <tr class="border-b">
                    <td class="py-2 px-4">{{ $o->id }}</td>
                    <td class="py-2 px-4">{{ $o->user->name ?? 'Khách' }}</td>
                    <td class="py-2 px-4">
                        @foreach($o->items as $item)
                            <div>{{ $item->product->name ?? 'Sản phẩm đã xóa' }} (x{{ $item->quantity }})</div>
                        @endforeach
                    </td>
                    <td class="py-2 px-4 font-bold text-red-600">{{ number_format($o->total) }}đ</td>
                    <td class="py-2 px-4">{{ ucfirst($o->status) }}</td>
                    <td class="py-2 px-4">
                        <button onclick="openStatusModal({{ $o->id }}, '{{ $o->status }}')" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">✏️ Cập nhật</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</div>

<!-- Modal cập nhật trạng thái -->
<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h3 class="text-xl font-bold mb-4">Cập nhật trạng thái đơn hàng</h3>
        <form id="statusForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block font-semibold">Trạng thái</label>
                <select name="status" class="w-full border px-3 py-2 rounded">
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeStatusModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Đóng</button>
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">Lưu</button>
            </div>
        </form>
    </div>
</div>

<script>
function openStatusModal(id,status){
    const form = document.getElementById('statusForm');
    form.action='/admin/orders/'+id+'/status';
    form.querySelector('[name="status"]').value=status;
    document.getElementById('statusModal').classList.remove('hidden');
    document.getElementById('statusModal').classList.add('flex');
}

function closeStatusModal(){
    document.getElementById('statusModal').classList.add('hidden');
}
</script>
@endsection

