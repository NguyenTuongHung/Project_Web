<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Xử lý dữ liệu form, ví dụ lưu vào database hoặc gửi email
        // $request->input('name'), $request->input('email'), $request->input('message')

        return back()->with('success', 'Cảm ơn bạn đã liên hệ!');
    }
}
