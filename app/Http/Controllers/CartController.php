<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CartController extends Controller
{
    // Trang checkout
    public function showCheckout()
    {
        return view('checkout'); // hiển thị giỏ hàng từ localStorage, không cần lấy latest order
    }

    // Xử lý thanh toán
    public function checkout(Request $request)
    {
        $cart = $request->input('cart');
        $payment = $request->input('payment_method', 'cod');
        $user = auth()->user();

        if (!$cart || count($cart) == 0) {
            return response()->json(['error' => 'Giỏ hàng trống']);
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'pending',
            'payment_method' => $payment,
        ]);

        foreach ($cart as $item) {
            $order->items()->create([
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Notification
        $user->notify(new \App\Notifications\OrderPlaced($order));

        // Trả về JSON kèm link redirect để JS chuyển trang
        return response()->json([
            'success' => true,
            'order_id' => $order->id,
            'redirect' => route('orders.show', $order->id)
        ]);
    }
}






