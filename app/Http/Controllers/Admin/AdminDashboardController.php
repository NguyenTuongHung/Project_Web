<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $productCount = Product::count();
        $orderCount = Order::count();
        $userCount = User::count();

        $latestProducts = Product::orderBy('created_at','desc')->take(5)->get();
        $latestOrders = Order::with('user','items')->orderBy('created_at','desc')->take(5)->get();

        return view('admin.dashboard', compact('productCount','orderCount','userCount','latestProducts','latestOrders'));
    }

    // Products
    public function products() { 
        $products = Product::all(); 
        return view('admin.products', compact('products')); 
    }
    public function storeProduct(Request $r){ 
        $data = $r->validate([
            'name'=>'required|string|max:255',
            'desc'=>'nullable|string',
            'price'=>'required|numeric',
            'sale_price'=>'nullable|numeric',
            'is_sale'=>'nullable|boolean',
            'img'=>'nullable|string'
        ]); 
        Product::create($data); 
        return back()->with('success','Thêm sản phẩm thành công'); 
    }
    public function updateProduct(Request $r,$id){ 
        $product=Product::findOrFail($id); 
        $data=$r->validate([
            'name'=>'required|string|max:255',
            'desc'=>'nullable|string',
            'price'=>'required|numeric',
            'sale_price'=>'nullable|numeric',
            'is_sale'=>'nullable|boolean',
            'img'=>'nullable|string'
        ]); 
        $product->update($data); 
        return back()->with('success','Cập nhật sản phẩm thành công'); 
    }
    public function deleteProduct($id){ 
        Product::findOrFail($id)->delete(); 
        return back()->with('success','Xóa sản phẩm thành công'); 
    }

    // Orders
    public function orders() { 
        $orders=Order::with('user','items')->get(); 
        return view('admin.orders', compact('orders')); 
    }
    public function updateOrderStatus(Request $r,$id){
        $order=Order::findOrFail($id);
        $r->validate(['status'=>'required|in:pending,processing,completed,canceled']);
        $order->status = $r->status;
        $order->save();
        return response()->json(['success'=>true,'status'=>$order->status]);
    }

    // Users
    public function users(){ 
        $users=User::all(); 
        return view('admin.users', compact('users')); 
    }
    public function updateUser(Request $r,$id){ 
        $user=User::findOrFail($id); 
        $data=$r->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'phone'=>'nullable|string|max:20'
        ]); 
        $user->update($data); 
        return back()->with('success','Cập nhật user thành công'); 
    }
}











