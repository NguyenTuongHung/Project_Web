@extends('layouts.app')
@section('title','Lịch sử đơn hàng')
@section('content')
<div class="max-w-5xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Lịch sử đơn hàng</h1>
    <div class="space-y-4">
        @foreach($orders as $order)
        <div class="bg-white p-4 rounded shadow">
            <div class="flex justify-between mb-2">
                <span>Đơn #{{ $order->id }}</span>
                <span class="text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                <span class="px-2 py-1 rounded {{ $order->status }}">{{ ucfirst($order->status) }}</span>
            </div>
            <ul class="list-disc pl-5">
                @foreach($order->items as $item)
                    <li>{{ $item->product->name ?? 'Sản phẩm đã xóa' }} - {{ $item->quantity }} x {{ number_format($item->price) }}đ</li>
                @endforeach
            </ul>
            <div class="text-right font-semibold mt-2">
                Tổng: {{ number_format($order->items->sum(fn($i)=>$i->quantity*$i->price)) }}đ
            </div>
        </div>
        @endforeach
    </div>
</div>
<style>
.pending{background:#FEF3C7;color:#92400E;}
.processing{background:#BFDBFE;color:#1E40AF;}
.completed{background:#DCFCE7;color:#166534;}
.canceled{background:#FECACA;color:#991B1B;}
</style>
@endsection

