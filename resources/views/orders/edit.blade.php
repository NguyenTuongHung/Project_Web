@extends('layouts.app')

@section('content')
<h2>Chỉnh sửa đơn hàng #{{ $order->id }}</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('orders.update', $order->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="quantity">Số lượng:</label>
        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $order->quantity) }}" min="1" required>
    </div>
    <button type="submit">Cập nhật đơn hàng</button>
</form>

<a href="{{ route('orders.history') }}">Quay lại lịch sử đơn hàng</a>
@endsection

