<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name','Nội Thất Xinh') }}</title>

    <!-- CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Vite / Tailwind (nếu dùng vite) -->
    @if (file_exists(public_path('build')))
        <!-- nếu bạn đã build bằng vite -->
        <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
        <script type="module" src="{{ asset('build/assets/app.js') }}" defer></script>
    @else
        <!-- fallback: dùng CDN Tailwind cho nhanh -->
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        @keyframes fadeIn { from {opacity:0; transform:translateY(20px);} to {opacity:1; transform:translateY(0);} }
        .animate-fadeIn { animation: fadeIn 0.45s ease forwards; }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body class="bg-green-50 font-sans text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <a href="/" class="text-2xl font-bold text-green-700">Nội Thất Xinh</a>
            <nav class="space-x-6 flex items-center">
                <a href="/" class="text-green-700 hover:text-green-900 transition">Trang chủ</a>
                <a href="#map" class="text-green-700 hover:text-green-900 transition">Bản đồ</a>
                <a href="#products" class="text-green-700 hover:text-green-900 transition">Sản phẩm</a>
                <a href="#contact" class="text-green-700 hover:text-green-900 transition">Liên hệ</a>

                @auth
                    <span class="ml-4 text-green-900 font-semibold">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline ml-2">
                        @csrf
                        <button type="submit" class="text-green-700 hover:text-green-900 transition">Đăng xuất</button>
                    </form>
                @else
                    <button onclick="openAuthModal('login')" class="text-green-700 hover:text-green-900 transition ml-4">Đăng nhập</button>
                    <button onclick="openAuthModal('register')" class="text-green-700 hover:text-green-900 transition ml-2">Đăng ký</button>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Main -->
    <main class="mt-16">
        @yield('content')
    </main>

    <!-- Footer (ở layout để tránh lặp) -->
    <footer class="bg-green-700 text-white py-8 mt-10">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <p>© {{ date('Y') }} Nội Thất Xinh. All rights reserved.</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-green-300 transition">Facebook</a>
                <a href="#" class="hover:text-green-300 transition">Instagram</a>
                <a href="#" class="hover:text-green-300 transition">TikTok</a>
            </div>
        </div>
    </footer>

    {{-- Nếu bạn dùng Vite, include script ở đây, nếu không thì dùng CDN trong welcome --}}
    @stack('scripts')

   
    
</body>
 
</html>
