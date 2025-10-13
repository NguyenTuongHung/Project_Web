@extends('layouts.app')

@section('content')
<h2>Tạo đơn hàng mới</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <div>
        <label for="product_id">Sản phẩm:</label>
        <input type="number" name="product_id" id="product_id" value="{{ old('product_id') }}" required>
    </div>
    <div>
        <label for="quantity">Số lượng:</label>
        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1" required>
    </div>
    <button type="submit">Tạo đơn hàng</button>
</form>

<a href="{{ route('orders.history') }}">Quay lại lịch sử đơn hàng</a>
@endsection

