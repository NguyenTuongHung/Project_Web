@extends('layouts.order')

@section('title', 'Lịch sử đơn hàng')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-green-700">Lịch sử đơn hàng của bạn</h1>

@if($orders->count())
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-md shadow-sm">
            <thead class="bg-green-100 text-green-900 font-semibold">
                <tr>
                    <th class="p-3 border">Mã đơn</th>
                    <th class="p-3 border">Ngày tạo</th>
                    <th class="p-3 border">Tổng tiền</th>
                    <th class="p-3 border">Trạng thái</th>
                    <th class="p-3 border">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr class="text-center hover:bg-green-50 transition">
                    <td class="p-3 border font-semibold">{{ $order->id }}</td>
                    <td class="p-3 border">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-3 border text-red-600 font-bold">{{ number_format($order->total ?? 0) }}đ</td>
                    <td class="p-3 border capitalize">{{ $order->status ?? 'pending' }}</td>
                    <td class="p-3 border">
                        <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:underline">Xem chi tiết</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
       {{ $orders->links() }}

    </div>
@else
    <p class="text-gray-600">Bạn chưa có đơn hàng nào.</p>
@endif
@endsection







