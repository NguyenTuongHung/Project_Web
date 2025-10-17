<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $productCount = Product::count();
        $userCount    = User::count();
        $orderCount   = Order::count();

        $latestProducts = Product::latest()->take(5)->get();
        $latestOrders   = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'productCount',
            'userCount',
            'orderCount',
            'latestProducts',
            'latestOrders'
        ));
    }
}




