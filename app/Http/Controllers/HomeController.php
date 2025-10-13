<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();

        // Lấy đơn hàng user nếu đăng nhập
        $orders = collect();
        if (Auth::check()) {
            $orders = Auth::user()->orders()->with('items.product')->latest()->get();
        }

        return view('welcome', compact('products', 'orders'));
    }

    public function checkout(Request $request)
    {
        $cart = $request->input('cart', []);
        if (empty($cart)) return response()->json(['success'=>false,'error'=>'Giỏ hàng trống']);

        $order = null;
        if (class_exists(Order::class)) {
            $order = Order::create([
                'user_id' => Auth::id() ?? null,
                'total' => array_sum(array_column($cart, 'price')),
                'status' => 'pending'
            ]);
            if (class_exists(OrderItem::class)) {
                foreach ($cart as $item) {
                    OrderItem::create([
                        'order_id'=>$order->id,
                        'product_id'=>$item['id'],
                        'quantity'=>$item['quantity'],
                        'price'=>$item['price']
                    ]);
                }
            }
        } else {
            $order = (object)['id'=>rand(1000,9999)];
        }

        return response()->json(['success'=>true,'order_id'=>$order->id]);
    }
}



