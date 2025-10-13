@extends('layouts.app')
@section('content')
<div class="container mx-auto py-20 text-center">
    <h2 class="text-3xl font-bold mb-4">Thanh toán qua {{ strtoupper($method) }}</h2>
    <p>Mã đơn: {{ $order->id }}</p>
    <p>Tổng: {{ number_format($order->total) }}đ</p>
    <p class="mt-4">Đây là trang giả lập thanh toán.</p>
    <form action="{{ route('payment.complete', $order->id) }}" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">Xác nhận thanh toán</button>
    </form>
</div>
@endsection
