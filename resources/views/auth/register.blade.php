<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Nội Thất Xanh</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50 flex items-center justify-center h-screen">

<div class="bg-white shadow-lg rounded-lg w-96 p-8">
    <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Đăng ký</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-green-700 font-semibold">Họ và tên</label>
            <input type="text" name="name" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>
        <div class="mb-4">
            <label class="block text-green-700 font-semibold">Email</label>
            <input type="email" name="email" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>
        <div class="mb-4">
            <label class="block text-green-700 font-semibold">Mật khẩu</label>
            <input type="password" name="password" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>
        <div class="mb-4">
            <label class="block text-green-700 font-semibold">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>
        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded">Đăng ký</button>
    </form>

    <p class="text-center text-gray-600 mt-4">
        Đã có tài khoản?
        <a href="{{ route('login') }}" class="text-green-700 hover:underline">Đăng nhập</a>
    </p>
</div>
</body>
</html>
