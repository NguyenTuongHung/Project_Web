<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() { 
        $products = Product::latest()->get(); 
        return view('admin.products.index', compact('products')); 
    }
    public function create() { return view('admin.products.create'); }
    public function store(Request $r){
        $r->validate(['name'=>'required','price'=>'required|numeric','is_sale'=>'sometimes|boolean']);
        Product::create($r->only('name','price','is_sale'));
        return redirect()->route('admin.products')->with('success','Tạo sản phẩm thành công!');
    }
    public function edit(Product $product){ return view('admin.products.edit', compact('product')); }
    public function update(Request $r, Product $product){
        $r->validate(['name'=>'required','price'=>'required|numeric','is_sale'=>'sometimes|boolean']);
        $product->update($r->only('name','price','is_sale'));
        return redirect()->route('admin.products')->with('success','Cập nhật thành công!');
    }
    public function destroy(Product $product){ 
        $product->delete(); 
        return redirect()->route('admin.products')->with('success','Xóa thành công!');
    }
}

