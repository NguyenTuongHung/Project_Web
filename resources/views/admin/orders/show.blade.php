@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="p-8">
    <h1 class="text-3xl font-bold mb-6">Chi tiết đơn hàng #{{ $order->id }}</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Thông tin khách hàng</h2>
        <p><strong>Tên:</strong> {{ $order->user->name ?? 'Không có' }}</p>
        <p><strong>Email:</strong> {{ $order->user->email ?? 'Không có' }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Sản phẩm trong đơn hàng</h2>
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-green-600 text-white">
                    <th class="p-3">Tên sản phẩm</th>
                    <th class="p-3">Số lượng</th>
                    <th class="p-3">Giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr class="border-b">
                    <td class="p-3">{{ $item->product->name ?? 'Đã xóa' }}</td>
                    <td class="p-3">{{ $item->quantity }}</td>
                    <td class="p-3">{{ number_format($item->price) }}đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Cập nhật trạng thái</h2>

        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="status" class="block mb-2 font-semibold">Trạng thái:</label>
            <select name="status" id="status" class="border p-2 rounded w-64 mb-4">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
            </select>

            <div>
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    💾 Cập nhật trạng thái
                </button>
                <a href="{{ route('admin.orders.index') }}" 
                   class="ml-3 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    ⬅ Quay lại
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
