@extends('layouts.order')

@section('title', 'Chi tiết đơn hàng #'.$order->id)

@section('content')
<h1 class="text-3xl font-bold mb-6 text-green-700">Chi tiết đơn hàng #{{ $order->id }}</h1>

<div class="bg-white p-6 rounded-lg shadow-md">
    <p class="mb-2"><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    <p class="mb-2"><strong>Trạng thái:</strong> <span class="capitalize">{{ $order->status ?? 'pending' }}</span></p>
    <p class="mb-4"><strong>Tổng tiền:</strong> <span class="text-red-600 font-bold">{{ number_format($order->total ?? 0) }}đ</span></p>

    <h2 class="text-xl font-semibold mb-2">Sản phẩm:</h2>
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-md shadow-sm">
            <thead class="bg-green-100 text-green-900 font-semibold">
                <tr>
                    <th class="p-2 border">Tên SP</th>
                    <th class="p-2 border">Số lượng</th>
                    <th class="p-2 border">Giá</th>
                    <th class="p-2 border">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr class="text-center hover:bg-green-50 transition">
                    <td class="p-2 border">{{ $item->product->name ?? '' }}</td>
                    <td class="p-2 border">{{ $item->quantity }}</td>
                    <td class="p-2 border">{{ number_format($item->price) }}đ</td>
                    <td class="p-2 border text-red-600 font-bold">{{ number_format($item->price * $item->quantity) }}đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('orders.history') }}" class="text-green-700 hover:underline">&larr; Quay lại lịch sử</a>
    </div>
</div>
@endsection





