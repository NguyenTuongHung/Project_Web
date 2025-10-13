<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Trang chủ: hiển thị sản phẩm & sale
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->get();
        $saleProducts = Product::where('is_sale', true)->orderBy('updated_at','desc')->get();
        return view('welcome', compact('products','saleProducts'));
    }

    // Checkout: nhận cart từ JS (LocalStorage) và lưu order
    public function checkout(Request $request)
    {
        $cart = $request->input('cart');
        if (!$cart || count($cart) === 0) {
            return response()->json(['error' => 'Giỏ hàng trống'], 400);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += (int)$item['price'] * (int)$item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(), // null nếu chưa login
            'items' => $cart,
            'total' => $total,
            'status' => 'completed'
        ]);

        return response()->json(['success' => true, 'order_id' => $order->id]);
    }

    // Lịch sử đơn hàng (đơn giản)
    public function history()
    {
        $orders = Order::orderBy('created_at','desc')->get();
        return view('orders.history', compact('orders'));
    }


    // review san pham
    public function show($id)
{
    $product = Product::with('reviews.user')->findOrFail($id);
    $purchaseCount = $product->orders()->count();
    return view('products.show', compact('product', 'purchaseCount'));
}

}
