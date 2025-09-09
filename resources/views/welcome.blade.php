<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nội Thất Xanh - Trang Chủ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body class="bg-gray-100 font-sans">

<!-- Header -->
<header class="bg-green-700 shadow relative">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">🏠 Nội Thất Xanh Hưng Nguyễn</h1>
        <nav class="flex space-x-4 items-center">
            <a href="{{ route('home') }}" class="text-white hover:text-green-200">Trang chủ</a>
            <a href="#products" class="text-white hover:text-green-200">Sản phẩm</a>

            <!-- Cart button thay cho khuyến mãi -->
            <button onclick="toggleCart()" class="bg-yellow-400 text-green-900 px-3 py-1 rounded hover:bg-yellow-500 transition">🛒 Thanh toán</button>

            @auth
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-white">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-white text-green-700 px-3 py-1 rounded hover:bg-green-100">Đăng nhập</a>
                <a href="{{ route('register') }}" class="bg-yellow-400 px-3 py-1 rounded hover:bg-yellow-500">Đăng ký</a>
            @endauth
        </nav>
    </div>
</header>

<!-- Section giới thiệu -->
<section class="bg-green-100 py-16 text-center">
    <h2 class="text-4xl font-bold text-green-800">Khám phá không gian sống hiện đại</h2>
    <p class="text-green-700 mt-4">Sản phẩm nội thất chất lượng cao, thiết kế tinh tế.</p>
</section>

<!-- Sản phẩm nổi bật -->
<section id="products" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-green-900 mb-8 text-center">Sản phẩm nổi bật</h2>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach($products as $p)
                <div class="swiper-slide p-4">
                    <div class="bg-green-50 rounded-2xl shadow hover:shadow-xl transform hover:scale-105 transition overflow-hidden">
                        <img src="{{ asset($p->img) }}" class="w-full h-56 object-cover rounded-t-2xl">
                        <div class="p-5">
                            <h3 class="text-xl font-semibold text-green-900 mb-2">{{ $p->name }}</h3>
                            <p class="text-green-700">{{ Str::limit($p->desc, 80) }}</p>
                            <div class="mt-3">
                                @if($p->is_sale && $p->sale_price)
                                    <span class="text-red-600 font-bold">{{ number_format($p->sale_price) }}đ</span>
                                    <span class="line-through text-gray-400 ml-2">{{ number_format($p->price) }}đ</span>
                                @else
                                    <span class="text-green-900 font-bold">{{ number_format($p->price) }}đ</span>
                                @endif
                            </div>
                            <div class="mt-4 flex gap-2">
                                <button onclick="addToCart({{ $p->id }}, '{{ addslashes($p->name) }}', {{ $p->is_sale && $p->sale_price ? $p->sale_price : $p->price }})" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Thêm vào giỏ</button>
                                <button onclick="showProductDetail('{{ addslashes($p->name) }}','{{ addslashes($p->desc) }}','{{ asset($p->img) }}')" class="bg-white border px-4 py-2 rounded">Xem</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- Cart UI (fixed right) -->
<div id="cart-container" class="fixed top-24 right-5 bg-white shadow-lg rounded-lg p-4 w-80 border hidden z-50">
    <h4 class="font-bold mb-3">🛒 Giỏ hàng</h4>
    <div id="cart-items" class="max-h-48 overflow-y-auto"></div>
    <div class="mt-3 flex justify-between items-center">
        <div class="font-bold text-red-600" id="cart-total">0đ</div>
        <button onclick="checkout()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded">Thanh toán</button>
    </div>
</div>

<!-- Product Modal -->
<div id="productModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <img id="modal-img" class="w-full h-48 object-cover rounded" alt="image">
        <h3 id="modal-name" class="mt-3 text-xl font-bold"></h3>
        <p id="modal-desc" class="text-gray-600 mt-2"></p>
        <div class="mt-4 text-right">
            <button onclick="closeProductModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Đóng</button>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-green-700 text-white mt-16">
    <div class="container mx-auto px-6 py-10 grid md:grid-cols-3 gap-8">
        <!-- Thông tin liên hệ -->
        <div>
            <h3 class="text-xl font-bold mb-4">Liên hệ</h3>
            <p>🏠 Địa chỉ: 123 Đường Nội Thất, TP.HCM</p>
            <p>📞 Điện thoại: 0123 456 789</p>
            <p>✉️ Email: info@noithatxanh.com</p>
        </div>

        <!-- Liên hệ nhanh -->
        <div>
            <h3 class="text-xl font-bold mb-4">Gửi liên hệ</h3>
            <form action="{{ route('contact.submit') }}" method="POST" class="space-y-3">
                @csrf
                <input type="text" name="name" placeholder="Họ tên" class="w-full px-3 py-2 rounded text-black">
                <input type="email" name="email" placeholder="Email" class="w-full px-3 py-2 rounded text-black">
                <textarea name="message" placeholder="Nội dung" class="w-full px-3 py-2 rounded text-black"></textarea>
                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 px-4 py-2 rounded text-green-900 font-bold">Gửi</button>
            </form>
        </div>

        <!-- Mạng xã hội -->
        <div>
            <h3 class="text-xl font-bold mb-4">Theo dõi chúng tôi</h3>
            <div class="flex mt-4 space-x-3">
                <a href="https://facebook.com" target="_blank" class="hover:text-blue-500" title="Facebook">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2v-3h2v-2c0-2 1.2-3 3-3h2v3h-1c-1 0-1 .5-1 1v1h2l-1 3h-1v7A10 10 0 0 0 22 12z"/></svg>
                </a>
                <a href="https://zalo.me" target="_blank" class="hover:text-blue-400" title="Zalo">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.372 0 0 5.373 0 12c0 6.628 5.372 12 12 12s12-5.372 12-12c0-6.627-5.372-12-12-12zm1.14 17h-2.28l-.86-2h-2.5v-1.5h2.56l.54-1.5h-2.1V11h2.66l.86-2h1.74l-1.12 2h1.9v1.5h-2.24l-.54 1.5h2.06V15h-1.86l-1.02 2z"/></svg>
                </a>
                <a href="https://www.tiktok.com" target="_blank" class="hover:text-pink-500" title="TikTok">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0v9a3 3 0 1 0 3-3h3a6 6 0 1 1-6 6V0z"/></svg>
                </a>
                <a href="https://www.instagram.com" target="_blank" class="hover:text-pink-400" title="Instagram">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.2c3.2 0 3.584.012 4.85.07 1.17.055 1.97.24 2.428.403.59.2 1.014.44 1.46.885.446.446.685.87.886 1.46.163.457.347 1.257.403 2.427.058 1.265.07 1.648.07 4.85s-.012 3.584-.07 4.85c-.056 1.17-.24 1.97-.403 2.428-.2.59-.44 1.014-.885 1.46-.446.446-.87.685-1.46.886-.457.163-1.257.347-2.427.403-1.265.058-1.648.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.056-1.97-.24-2.428-.403-.59-.2-1.014-.44-1.46-.885-.446-.446-.685-.87-.886-1.46-.163-.457-.347-1.257-.403-2.427C2.212 15.584 2.2 15.2 2.2 12s.012-3.584.07-4.85c.056-1.17.24-1.97.403-2.428.2-.59.44-1.014.885-1.46.446-.446.87-.685 1.46-.886.457-.163 1.257-.347 2.427-.403C8.416 2.212 8.8 2.2 12 2.2zm0 1.8c-3.17 0-3.55.012-4.8.07-1.04.048-1.61.22-1.987.367-.5.2-.857.44-1.23.812-.374.374-.613.73-.813 1.23-.147.376-.32.947-.367 1.987-.058 1.25-.07 1.63-.07 4.8s.012 3.55.07 4.8c.048 1.04.22 1.61.367 1.987.2.5.44.857.813 1.23.374.374.73.613 1.23.813.376.147.947.32 1.987.367 1.25.058 1.63.07 4.8.07s3.55-.012 4.8-.07c1.04-.048 1.61-.22 1.987-.367.5-.2.857-.44 1.23-.813.374-.374.613-.73.813-1.23.147-.376.32-.947.367-1.987.058-1.25.07-1.63.07-4.8s-.012-3.55-.07-4.8c-.048-1.04-.22-1.61-.367-1.987-.2-.5-.44-.857-.813-1.23-.374-.374-.73-.613-1.23-.813-.376-.147-.947-.32-1.987-.367-1.25-.058-1.63-.07-4.8-.07zm0 3a6 6 0 1 1 0 12 6 6 0 0 1 0-12zm0 1.8a4.2 4.2 0 1 0 0 8.4 4.2 4.2 0 0 0 0-8.4zm5.4-.9a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4z"/></svg>
                </a>
            </div>
        </div>
    </div>
    <div class="text-center text-gray-200 mt-6">&copy; 2025 Nội Thất Xanh. Bản quyền thuộc Hưng Nguyễn.</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Swiper init
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 15,
        loop: true,
        autoplay: { delay: 3000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        breakpoints: { 640: { slidesPerView: 2 }, 1024: { slidesPerView: 3 } }
    });

    // Cart functions
    function getCart() { return JSON.parse(localStorage.getItem('cart') || '[]'); }
    function saveCart(cart) { localStorage.setItem('cart', JSON.stringify(cart)); renderCart(); }
    function addToCart(id,name,price){let cart=getCart();let item=cart.find(i=>i.id===id);if(item)item.quantity++;else cart.push({id,name,price,quantity:1});saveCart(cart);alert('Đã thêm vào giỏ hàng');}
    function renderCart(){let cart=getCart();let container=document.getElementById('cart-items');if(!container)return;if(cart.length===0){container.innerHTML='<p class="text-gray-500">Giỏ hàng trống</p>';document.getElementById('cart-total').innerText='0đ';return;}let html='';let total=0;cart.forEach((it,idx)=>{total+=it.price*it.quantity;html+=`<div class="flex justify-between items-center mb-2"><div><div class="font-semibold">${it.name}</div><div class="text-sm text-gray-600">Số lượng: ${it.quantity}</div></div><div class="text-right"><div class="font-bold text-red-600">${it.price.toLocaleString()}đ</div><div class="mt-1 flex gap-1 justify-end"><button onclick="changeQuantity(${idx}, -1)" class="px-2 bg-gray-200 rounded">-</button><button onclick="changeQuantity(${idx}, 1)" class="px-2 bg-gray-200 rounded">+</button></div></div></div>`;});container.innerHTML=html;document.getElementById('cart-total').innerText=total.toLocaleString()+'đ';}
    function changeQuantity(index,delta){let cart=getCart();if(!cart[index])return;cart[index].quantity+=delta;if(cart[index].quantity<=0)cart.splice(index,1);saveCart(cart);}
    function checkout(){let cart=getCart();if(cart.length===0){alert('Giỏ hàng trống');return;}fetch("{{ route('checkout') }}",{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},body:JSON.stringify({cart})}).then(res=>res.json()).then(data=>{if(data.success){alert('Đặt hàng thành công (Mã: '+data.order_id+')');localStorage.removeItem('cart');renderCart();}else{alert(data.error||'Có lỗi xảy ra');}}).catch(e=>{console.error(e);alert('Lỗi kết nối');});}

    function toggleCart(){let c=document.getElementById('cart-container');c.classList.toggle('hidden');}

    // Product Modal
    function showProductDetail(name,desc,img){document.getElementById('modal-name').innerText=name;document.getElementById('modal-desc').innerText=desc;document.getElementById('modal-img').src=img;document.getElementById('productModal').classList.remove('hidden');document.getElementById('productModal').classList.add('flex');}
    function closeProductModal(){document.getElementById('productModal').classList.add('hidden');}

    document.addEventListener('DOMContentLoaded', renderCart);
</script>

</body>
</html>

