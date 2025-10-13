<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User - Quản lý đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Trang chủ</a>
            <a class="nav-link" href="{{ route('orders.index') }}">Đơn hàng</a>
            <a class="nav-link" href="{{ route('orders.history') }}">Lịch sử đơn hàng</a>
            <a class="nav-link" href="{{ route('profile.edit') }}">Hồ sơ của tôi</a>

            <div class="ms-auto d-flex align-items-center">
                <span class="me-2">Xin chào, <strong>{{ Auth::user()->name }}</strong></span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">Đăng xuất</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>
</body>
</html>


