<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-green-700 min-h-screen text-white p-6 space-y-6">
        <h1 class="text-2xl font-bold mb-8">Admin Panel</h1>
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-green-600">Dashboard</a>
            <a href="{{ route('admin.products') }}" class="block px-3 py-2 rounded hover:bg-green-600">Sản phẩm</a>
            <a href="{{ route('admin.orders.index') }}" class="block px-3 py-2 rounded hover:bg-green-600">Đơn hàng</a>
            <a href="{{ route('admin.users') }}" class="block px-3 py-2 rounded hover:bg-green-600">Người dùng</a>
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-2 rounded w-full">Đăng xuất</button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto">
        @yield('content')
    </main>
</body>
</html>
