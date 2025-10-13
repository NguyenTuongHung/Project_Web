<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!Gate::allows('admin-access')) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập!');
        }

        return view('admin.dashboard');
    }
}

