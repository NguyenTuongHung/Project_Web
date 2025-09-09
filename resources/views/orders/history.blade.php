@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">📜 Lịch sử đơn hàng</h1>

    @forelse($orders as $order)
        <div class="bg-white shadow rounded p-4 mb-4">
            <div class="flex justify-between">
                <div>
                    <div class="font-bold">Đơn hàng #{{ $order->id }}</div>
                    <div class="text-sm text-gray-500">Ngày: {{ $order->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="text-right">
                    <div class="font-semibold text-red-600">{{ number_format($order->total) }}đ</div>
                    <div class="text-sm text-gray-500">{{ ucfirst($order->status) }}</div>
                </div>
            </div>

            <div class="mt-3">
                <h4 class="font-semibold">Sản phẩm</h4>
                <ul class="list-disc list-inside">
                    @foreach($order->items as $item)
                        <li>{{ $item['name'] }} x{{ $item['quantity'] }} — {{ number_format($item['price']) }}đ</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Chưa có đơn hàng nào.</p>
    @endforelse
</div>
@endsection

