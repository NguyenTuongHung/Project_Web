<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-green-50 text-gray-800">
    <div class="min-h-screen flex flex-col">
        <!-- Nội dung chính -->
        <main class="flex-1">
            @yield('content')
        </main>
    </div>
</body>
</html>

