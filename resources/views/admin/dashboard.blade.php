@extends('layouts.admin')
@section('title','Admin Dashboard')
@section('content')
<div class="flex min-h-screen bg-green-50">
    <!-- resources/views/admin/partials/sidebar.blade.php -->
<aside class="w-64 bg-green-700 text-white flex flex-col">
    <div class="p-6 text-center border-b border-green-600">
        <h2 class="text-2xl font-bold">Admin Panel</h2>
    </div>
    <nav class="flex-1 p-4">
        <ul class="space-y-3">
            <li><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-green-600">🏠 Dashboard</a></li>
            <li><a href="{{ route('admin.products') }}" class="block px-4 py-2 rounded hover:bg-green-600">📦 Quản lý sản phẩm</a></li>
            <li><a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 rounded hover:bg-green-600">🛒 Đơn hàng</a></li>
            <li><a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded hover:bg-green-600">👤 Người dùng</a></li>
            <li>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-green-600">🚪 Đăng xuất</button>
                </form>
            </li>
        </ul>
    </nav>
</aside>

    <main class="flex-1 p-8 overflow-auto">
        <h1 class="text-3xl font-bold text-green-900 mb-6">Chào mừng Admin!</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('admin.products') }}" class="bg-white p-6 rounded-2xl shadow hover:shadow-xl block">
                <h2 class="text-xl font-semibold text-green-800 mb-2">Sản phẩm</h2>
                <p class="text-gray-600">Tổng số sản phẩm: <b>{{ $productCount }}</b></p>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="bg-white p-6 rounded-2xl shadow hover:shadow-xl block">
                <h2 class="text-xl font-semibold text-green-800 mb-2">Đơn hàng</h2>
                <p class="text-gray-600">Đơn hàng mới: <b>{{ $orderCount }}</b></p>
            </a>
            <a href="{{ route('admin.users') }}" class="bg-white p-6 rounded-2xl shadow hover:shadow-xl block">
                <h2 class="text-xl font-semibold text-green-800 mb-2">Người dùng</h2>
                <p class="text-gray-600">Tổng số user: <b>{{ $userCount }}</b></p>
            </a>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="font-semibold mb-2">Sản phẩm mới nhất</h3>
                <ul class="list-disc pl-5">
                    @foreach($latestProducts as $p)<li>{{ $p->name }} - {{ number_format($p->price) }}đ</li>@endforeach
                </ul>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow">
                <h3 class="font-semibold mb-2">Đơn hàng mới</h3>
                <ul class="list-disc pl-5">
                    @foreach($latestOrders as $o)<li>Đơn #{{ $o->id }} - {{ $o->user->name ?? 'Khách' }} - {{ ucfirst($o->status) }}</li>@endforeach
                </ul>
            </div>
        </div>
    </main>
</div>
@endsection







