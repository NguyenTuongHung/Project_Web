<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function gateway(Order $order, $method){
        return view('payment.gateway', compact('order','method'));
    }

    public function complete(Order $order){
        $order->update(['status'=>'completed']);
        return redirect()->route('user.profile')->with('success','Thanh toán thành công!');
    }
}

