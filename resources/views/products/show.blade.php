@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $product->name }}</h2>
    <p>{{ $product->description }}</p>
    <p><strong>Giá:</strong> {{ $product->price }} VNĐ</p>
    <p><strong>Số lượt mua:</strong> {{ $purchaseCount }}</p>

    <hr>
    <h4>Đánh giá sản phẩm</h4>
    @foreach($product->reviews as $review)
        <div>
            <strong>{{ $review->user->name }}</strong> - {{ $review->rating }}⭐
            <p>{{ $review->comment }}</p>
        </div>
    @endforeach

    @auth
    <form action="{{ route('reviews.store', $product->id) }}" method="POST">
        @csrf
        <label for="rating">Đánh giá:</label>
        <select name="rating" required>
            <option value="5">5⭐</option>
            <option value="4">4⭐</option>
            <option value="3">3⭐</option>
            <option value="2">2⭐</option>
            <option value="1">1⭐</option>
        </select>
        <textarea name="comment" placeholder="Viết bình luận..."></textarea>
        <button type="submit">Gửi</button>
    </form>
    @endauth
</div>
@endsection
