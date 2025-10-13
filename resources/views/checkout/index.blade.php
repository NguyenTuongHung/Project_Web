@extends('layouts.app')
@section('title','Thanh toán')

@section('content')
<div class="max-w-4xl mx-auto mt-8 bg-white shadow-md rounded-lg p-6 animate-fadeIn">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Thanh toán đơn hàng</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if($cart && count($cart) > 0)
        <table class="w-full text-left border border-gray-200 mb-6">
            <thead>
                <tr class="bg-green-50">
                    <th class="p-2 border-b">Sản phẩm</th>
                    <th class="p-2 border-b">Giá</th>
                    <th class="p-2 border-b">Số lượng</th>
                    <th class="p-2 border-b">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                    <tr>
                        <td class="p-2 border-b">{{ $item['name'] }}</td>
                        <td class="p-2 border-b">{{ number_format($item['price'],0,',','.') }}₫</td>
                        <td class="p-2 border-b">{{ $item['quantity'] }}</td>
                        <td class="p-2 border-b">{{ number_format($subtotal,0,',','.') }}₫</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-between items-center mb-6">
            <span class="font-bold text-lg">Tổng cộng:</span>
            <span class="font-bold text-lg text-green-700">{{ number_format($total,0,',','.') }}₫</span>
        </div>

        <form action="{{ route('checkout') }}" method="POST" class="space-y-4">
            @csrf
            <h2 class="text-xl font-semibold text-green-700">Phương thức thanh toán</h2>
            <div class="space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="payment_method" value="cod" checked class="form-radio text-green-700">
                    <span class="ml-2">Thanh toán khi nhận hàng (COD)</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="payment_method" value="momo" class="form-radio text-green-700">
                    <span class="ml-2">Thanh toán Momo</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="payment_method" value="paypal" class="form-radio text-green-700">
                    <span class="ml-2">PayPal</span>
                </label>
            </div>

            <input type="hidden" name="cart" value="{{ json_encode($cart) }}">

            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded hover:bg-green-800 transition">
                Đặt hàng
            </button>
        </form>
    @else
        <div class="text-center text-gray-500 py-10">
            Giỏ hàng trống. <a href="{{ route('home') }}" class="text-green-700 underline">Quay về trang chủ</a>
        </div>
    @endif
</div>
@endsection
