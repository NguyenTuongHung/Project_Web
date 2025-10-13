@extends('layouts.user')

@section('content')
<div class="container">
    <h2 class="mb-4">👤 Hồ sơ của tôi</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Ảnh đại diện</label><br>
            @if($user->avatar)
                <img src="{{ asset('storage/'.$user->avatar) }}" class="rounded-circle mb-2" width="100" height="100">
            @endif
            <input type="file" name="avatar" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Họ tên</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Số điện thoại</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Địa chỉ</label>
            <textarea name="address" class="form-control">{{ old('address', $user->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Mật khẩu mới (nếu muốn thay đổi)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật thông tin</button>
    </form>
</div>
@endsection



