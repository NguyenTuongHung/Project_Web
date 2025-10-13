@extends('layouts.app')
@section('content')
<div class="container mx-auto py-10">
    <h2 class="text-3xl font-bold mb-6">Hồ sơ của tôi</h2>
    <div class="bg-white p-6 rounded shadow mb-8">
        <h3 class="text-xl font-semibold mb-4">Thông tin cá nhân</h3>
        <p><strong>Họ tên:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Điện thoại:</strong> {{ $user->phone }}</p>
        <p><strong>Địa chỉ:</strong> {{ $user->address }}</p>
    </div>
    <div class="bg-white p-6 rounded shadow mb-8">
        <h3 class="text-xl font-semibold mb-4">Lịch sử đơn hàng</h3>
        @foreach($orders as $order)
            <div class="border-b py-4">
                <p><strong>Mã đơn:</strong> {{ $order->id }} | <strong>Trạng thái:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Thanh toán:</strong> {{ strtoupper($order->payment_method) }}</p>
                <p><strong>Tổng:</strong> {{ number_format($order->total) }}đ</p>
                <ul class="ml-4 mt-2">
                    @foreach($order->items as $item)
                        <li>{{ $item->product->name }} x {{ $item->quantity }} - {{ number_format($item->price) }}đ</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
@endsection
