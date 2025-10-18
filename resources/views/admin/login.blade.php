@extends('layouts.admin')

@section('title', 'Đăng nhập Admin')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-green-100">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-3xl flex overflow-hidden">
        
        <!-- Cột form (lớn hơn) -->
        <div class="w-full md:w-2/3 p-8">
            <h1 class="text-2xl font-bold text-green-700 text-center mb-6">Đăng nhập Admin</h1>

            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                           class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 
                                  focus:ring-green-500 focus:border-green-500"
                           required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Mật khẩu</label>
                    <input type="password" name="password" id="password"
                           class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 
                                  focus:ring-green-500 focus:border-green-500"
                           required>
                </div>

                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition">
                    Đăng nhập
                </button>
            </form>
        </div>

        <!-- Cột ảnh (nhỏ hơn, 1/3) -->
        <div class="hidden md:flex w-1/3 bg-green-50 items-center justify-center p-4">
            <img src="{{ asset('images/admin.jpg') }}" 
                 alt="Admin Login" 
                 class="max-h-72 rounded-lg shadow">
        </div>
    </div>
</div>
@endsection








