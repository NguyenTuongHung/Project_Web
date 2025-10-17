@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

@section('content')
<div class="p-8">
    <h1 class="text-3xl font-bold mb-6">Danh sách đơn hàng</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-green-600 text-white text-left">
                <th class="p-3">ID</th>
                <th class="p-3">Khách hàng</th>
                <th class="p-3">Tổng tiền</th>
                <th class="p-3">Trạng thái</th>
                <th class="p-3">Ngày tạo</th>
                <th class="p-3 text-center">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="border-b hover:bg-gray-100">
                <td class="p-3">{{ $order->id }}</td>
                <td class="p-3">{{ $order->user->name ?? 'N/A' }}</td>
                <td class="p-3">{{ number_format($order->total ?? 0) }}đ</td>
                <td class="p-3 capitalize">{{ $order->status }}</td>
                <td class="p-3">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td class="p-3 text-center">
                    <a href="{{ route('admin.orders.show', $order->id) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                        Xem chi tiết
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
