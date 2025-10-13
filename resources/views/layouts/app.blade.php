<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name','Nội Thất Xanh'))</title>

    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS / Vite -->
    @if (file_exists(public_path('build')))
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
        <script type="module" src="{{ asset('build/assets/app.js') }}" defer></script>
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom style -->
    <style>
        @keyframes fadeIn { from {opacity:0; transform:translateY(20px);} to {opacity:1; transform:translateY(0);} }
        .animate-fadeIn { animation: fadeIn 0.45s ease forwards; }
    </style>
</head>
<body class="bg-green-50 font-sans text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-green-700">Nội Thất Xanh</a>
            <nav class="space-x-6 flex items-center">
                <a href="{{ route('home') }}" class="text-green-700 hover:text-green-900 transition">Trang chủ</a>
                <a href="#map" class="text-green-700 hover:text-green-900 transition">Bản đồ</a>
                <a href="#products" class="text-green-700 hover:text-green-900 transition">Sản phẩm</a>
                <a href="#contact" class="text-green-700 hover:text-green-900 transition">Liên hệ</a>
                @auth
                    <a href="{{ route('orders.history') }}" class="text-green-700 hover:text-green-900 transition">Lịch sử đơn hàng</a>
                    <div class="flex items-center space-x-3 ml-4">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-8 h-8 rounded-full">
                        @endif
                        <span class="text-green-900 font-semibold">Xin chào, {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline ml-2">
                            @csrf
                            <button type="submit" class="text-green-700 hover:text-green-900 transition">Đăng xuất</button>
                        </form>
                    </div>
                @else
                    <button onclick="openAuthModal('login')" class="text-green-700 hover:text-green-900 transition ml-4">Đăng nhập</button>
                    <button onclick="openAuthModal('register')" class="text-green-700 hover:text-green-900 transition ml-2">Đăng ký</button>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main content -->
    <main class="mt-20 min-h-[70vh] container mx-auto px-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-green-700 text-white py-8 mt-10">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <p>© {{ date('Y') }} Nội Thất Xanh. All rights reserved.</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-green-300 transition">Facebook</a>
                <a href="#" class="hover:text-green-300 transition">Instagram</a>
                <a href="#" class="hover:text-green-300 transition">TikTok</a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>

