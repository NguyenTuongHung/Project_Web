<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Hiển thị trang login admin
     */
    public function showLogin()
    {
        return view('admin.login'); // resources/views/admin/login.blade.php
    }

    /**
     * Xử lý login admin
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Dùng guard 'admin'
        if (Auth::guard('admin')->attempt(
            $request->only('email', 'password'),
            $request->filled('remember')
        )) {
            // Regenerate session
            $request->session()->regenerate();

            // Chuyển thẳng sang dashboard admin, không dùng intended
            return redirect()->route('admin.dashboard');
        }

        // Login thất bại
        return back()
            ->withErrors(['email' => 'Thông tin đăng nhập không đúng!'])
            ->onlyInput('email');
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // Hủy session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}



