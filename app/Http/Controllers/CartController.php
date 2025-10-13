<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CartController extends Controller
{
    public function checkout(Request $request){
        $cart = $request->input('cart');
        $payment = $request->input('payment_method','cod');
        $user = auth()->user();

        if(!$cart || count($cart)==0){
            return response()->json(['error'=>'Giỏ hàng trống']);
        }

        $total = collect($cart)->sum(fn($item)=>$item['price']*$item['quantity']);

        $order = Order::create([
            'user_id'=>$user->id,
            'total'=>$total,
            'status'=>'pending',
            'payment_method'=>$payment,
        ]);

        foreach($cart as $item){
            $order->items()->create([
                'product_id'=>$item['id'],
                'quantity'=>$item['quantity'],
                'price'=>$item['price'],
            ]);
        }

        // Notification
        $user->notify(new \App\Notifications\OrderPlaced($order));

        return response()->json(['success'=>true,'order_id'=>$order->id]);
    }

    public function showCheckout()
    {
        $order = auth()->user()->orders()->latest()->first();
        if (!$order) {
            return redirect()->route('home')->with('error', 'Bạn chưa có đơn hàng nào.');
        }
        return view('checkout', compact('order'));
    }
}





