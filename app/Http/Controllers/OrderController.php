<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Lịch sử đơn hàng phân trang
    public function history()
    {
        $orders = auth()->user()->orders()->orderBy('created_at','desc')->paginate(10);
        return view('orders.history', compact('orders'));
    }

    // Chi tiết đơn hàng
    public function show($id)
    {
        $order = auth()->user()->orders()->with('items.product')->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Các CRUD khác (create, store, edit, update, destroy)
    public function create(){ return view('orders.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id'=>'required|integer',
            'quantity'=>'required|integer|min:1',
        ]);
        $data['user_id'] = auth()->id();
        Order::create($data);

        return redirect()->route('orders.history')->with('success','Tạo đơn hàng thành công');
    }

    public function edit($id)
    {
        $order = auth()->user()->orders()->findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = auth()->user()->orders()->findOrFail($id);
        $data = $request->validate([
            'quantity'=>'required|integer|min:1',
        ]);
        $order->update($data);

        return redirect()->route('orders.history')->with('success','Cập nhật đơn hàng thành công');
    }

    public function destroy($id)
    {
        $order = auth()->user()->orders()->findOrFail($id);
        $order->delete();

        return redirect()->route('orders.history')->with('success','Xóa đơn hàng thành công');
    }
}





