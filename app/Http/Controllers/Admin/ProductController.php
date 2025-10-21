<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index() { 
        $products = Product::latest()->get(); 
        return view('admin.products.index', compact('products')); 
    }

    // Lưu sản phẩm mới
    public function store(Request $r){
        $r->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'is_sale' => 'sometimes|boolean',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        $data = $r->only('name','desc','price','sale_price','is_sale');

        // Upload ảnh nếu có
        if ($r->hasFile('img')) {
            $file = $r->file('img');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $data['img'] = 'images/'.$fileName;
        }

        Product::create($data);

        return redirect()->route('admin.products')->with('success','Tạo sản phẩm thành công!');
    }

    // Cập nhật sản phẩm
    public function update(Request $r, Product $product){
        $r->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'is_sale' => 'sometimes|boolean',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        $data = $r->only('name','desc','price','sale_price','is_sale');

        // Upload ảnh mới nếu có
        if ($r->hasFile('img')) {
            $file = $r->file('img');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $data['img'] = 'images/'.$fileName;
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success','Cập nhật thành công!');
    }

    // Xóa sản phẩm
    public function destroy(Product $product){ 
        $product->delete(); 
        return redirect()->route('admin.products')->with('success','Xóa thành công!');
    }
}




