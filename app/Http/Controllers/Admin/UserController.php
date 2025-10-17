<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Hiển thị danh sách người dùng
    public function index() {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Trang sửa
    public function edit(User $user) {
        return view('admin.users.edit', compact('user'));
    }

    // Cập nhật thông tin
    public function update(Request $r, User $user) {
        $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6',
        ]);

        $data = $r->only('name', 'email');
        if ($r->filled('password')) {
            $data['password'] = Hash::make($r->password);
        }

        $user->update($data);
        return redirect()->route('admin.users')->with('success', 'Cập nhật người dùng thành công!');
    }

    // Xóa người dùng
    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Đã xóa người dùng!');
    }
}

