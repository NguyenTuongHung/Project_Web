@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="flex min-h-screen bg-green-50">
    <!-- Sidebar -->
    <aside class="w-64 bg-green-700 text-white flex flex-col">
        <div class="p-6 text-center border-b border-green-600">
            <h2 class="text-2xl font-bold">Admin Panel</h2>
        </div>
        <nav class="flex-1 p-4">
            <ul class="space-y-3">
                <li><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-green-600 transition">🏠 Dashboard</a></li>
                <li><a href="{{ route('admin.products') }}" class="block px-4 py-2 rounded hover:bg-green-600 transition">📦 Quản lý sản phẩm</a></li>
                <li><a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 rounded hover:bg-green-600 transition">🛒 Đơn hàng</a></li>
                <li><a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded hover:bg-green-600 transition">👤 Người dùng</a></li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-green-600 transition">🚪 Đăng xuất</button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-8 overflow-auto">
        <h1 class="text-3xl font-bold text-green-900 mb-6">Quản lý sản phẩm</h1>

        <button onclick="openAddModal()" class="mb-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">➕ Thêm sản phẩm</button>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $p)
                <div class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition">
                    <img src="{{ asset($p->img) }}" class="w-full h-40 object-cover rounded mb-3" alt="{{ $p->name }}">
                    <h3 class="text-xl font-semibold text-green-800 mb-1">{{ $p->name }}</h3>
                    <p class="text-gray-600 mb-2">{{ Str::limit($p->desc, 80) }}</p>
                    <p class="font-bold text-red-600">{{ $p->is_sale && $p->sale_price ? number_format($p->sale_price) : number_format($p->price) }}đ</p>
                    <div class="mt-3 flex gap-2">
                        <button onclick="openEditModal({{ $p->id }}, '{{ addslashes($p->name) }}', '{{ addslashes($p->desc) }}', {{ $p->price }}, {{ $p->sale_price ?? 0 }}, {{ $p->is_sale ? 1 : 0 }}, '{{ $p->img }}')" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">✏️ Sửa</button>
                        <form action="{{ route('admin.products.delete', $p->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">🗑️ Xóa</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</div>

<!-- Modal Thêm / Sửa sản phẩm -->
<div id="productModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h3 id="modal-title" class="text-xl font-bold mb-4">Thêm sản phẩm</h3>
        <form id="productForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label class="block font-semibold">Tên sản phẩm</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-2">
                <label class="block font-semibold">Mô tả</label>
                <textarea name="desc" class="w-full border px-3 py-2 rounded"></textarea>
            </div>
            <div class="mb-2">
                <label class="block font-semibold">Giá</label>
                <input type="number" name="price" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-2">
                <label class="block font-semibold">Giá sale</label>
                <input type="number" name="sale_price" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-2 flex items-center gap-2">
                <input type="checkbox" name="is_sale" value="1">
                <label>Kích hoạt sale</label>
            </div>
            <div class="mb-4">
                <label class="block font-semibold">Ảnh (url)</label>
                <input type="text" name="img" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeProductModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Đóng</button>
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">Lưu</button>
            </div>
        </form>
    </div>
</div>

<script>
function openAddModal(){
    document.getElementById('modal-title').innerText='Thêm sản phẩm';
    const form = document.getElementById('productForm');
    form.action="{{ route('admin.products.store') }}";
    form.querySelector('[name="_method"]')?.remove();
    form.reset();
    document.getElementById('productModal').classList.remove('hidden');
    document.getElementById('productModal').classList.add('flex');
}

function openEditModal(id,name,desc,price,sale_price,is_sale,img){
    document.getElementById('modal-title').innerText='Sửa sản phẩm';
    const form = document.getElementById('productForm');
    form.action="/admin/products/"+id;
    let methodInput = form.querySelector('[name="_method"]');
    if(!methodInput){
        methodInput=document.createElement('input');
        methodInput.type='hidden';
        methodInput.name='_method';
        methodInput.value='PUT';
        form.appendChild(methodInput);
    }
    form.querySelector('[name="name"]').value=name;
    form.querySelector('[name="desc"]').value=desc;
    form.querySelector('[name="price"]').value=price;
    form.querySelector('[name="sale_price"]').value=sale_price;
    form.querySelector('[name="is_sale"]').checked=!!is_sale;
    form.querySelector('[name="img"]').value=img;
    document.getElementById('productModal').classList.remove('hidden');
    document.getElementById('productModal').classList.add('flex');
}

function closeProductModal(){
    document.getElementById('productModal').classList.add('hidden');
}
</script>
@endsection
