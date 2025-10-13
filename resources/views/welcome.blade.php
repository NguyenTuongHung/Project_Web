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

<!-- Header cố định -->
<header class="bg-green-700 shadow fixed top-0 left-0 w-full z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-white">🏠 Nội Thất Xanh Hưng Nguyễn</h1>
        <nav class="flex space-x-4 items-center">
            <a href="{{ route('home') }}" class="text-white hover:text-green-200">Trang chủ</a>
            <a href="#products" class="text-white hover:text-green-200">Sản phẩm</a>
            @auth
            <a href="{{ route('orders.history') }}" class="text-white hover:text-green-200">Lịch sử mua</a>
            @endauth
            <button onclick="goCheckout()" class="bg-yellow-400 text-green-900 px-3 py-1 rounded hover:bg-yellow-500 transition">Thanh toán</button>
            @auth
                <button onclick="openProfileModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded ml-2">Xin chào, {{ auth()->user()->name }}</button>
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

<div class="mt-24"></div> <!-- để header cố định không che -->

<!-- Hero -->
<section class="relative h-[400px] md:h-[500px] overflow-hidden">
    <video class="w-full h-full object-cover" autoplay muted loop>
        <source src="{{ asset('videos/videomodau.mp4') }}" type="video/mp4">
    </video>
    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
        <h2 class="text-4xl md:text-5xl font-bold text-white text-center">Khám phá không gian sống hiện đại</h2>
    </div>
</section>

<!-- Sản phẩm nổi bật -->
<section id="products" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-green-900 mb-8 text-center">Sản phẩm nổi bật</h2>
        <div class="swiper mySwiperProducts">
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

<!-- Cart -->
<div id="cart-container" class="fixed top-24 right-5 bg-white shadow-lg rounded-lg p-4 w-80 border hidden z-50">
    <h4 class="font-bold mb-3">🛒 Giỏ hàng</h4>
    <div id="cart-items" class="max-h-48 overflow-y-auto"></div>
    <div class="mt-3 flex flex-col gap-2">
        <div class="flex justify-between items-center">
            <div class="font-bold text-red-600" id="cart-total">0đ</div>
        </div>
        <select id="payment-method" class="w-full border px-3 py-1 rounded">
            <option value="cod">COD</option>
            <option value="bank">Chuyển khoản</option>
            <option value="momo">Ví Momo</option>
            <option value="paypal">PayPal</option>
        </select>
        <button onclick="goCheckout()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded">Thanh toán</button>
    </div>
</div>

<!-- Product modal -->
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

<!-- Profile modal -->
@auth
<div id="profileModal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h3 class="text-xl font-bold mb-4 text-green-900">Cập nhật hồ sơ</h3>
        <form id="profileForm" class="space-y-3">
            @csrf
            <div>
                <label class="block font-semibold">Họ tên</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full border px-3 py-2 rounded">
            </div>
            <div>
                <label class="block font-semibold">Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full border px-3 py-2 rounded">
            </div>
            <div>
                <label class="block font-semibold">Số điện thoại</label>
                <input type="text" name="phone" value="{{ Auth::user()->phone ?? '' }}" class="w-full border px-3 py-2 rounded">
            </div>
            <div>
                <label class="block font-semibold">Địa chỉ</label>
                <textarea name="address" class="w-full border px-3 py-2 rounded">{{ Auth::user()->address ?? '' }}</textarea>
            </div>
            <div>
                <label class="block font-semibold">Mật khẩu mới (nếu muốn)</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded">
            </div>
            <div>
                <label class="block font-semibold">Xác nhận mật khẩu</label>
                <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeProfileModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Đóng</button>
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">Lưu</button>
            </div>
        </form>
    </div>
</div>
@endauth

<!-- Notification -->
<div id="notify" class="fixed top-6 right-6 bg-green-600 text-white px-4 py-2 rounded shadow-lg opacity-0 transform translate-x-20 transition-all duration-300 z-50"></div>

<!-- Footer -->
<footer class="bg-green-700 text-white mt-16">
    <div class="container mx-auto px-6 py-10 grid md:grid-cols-3 gap-8">
        <div>
            <h3 class="text-xl font-bold mb-4">Liên hệ</h3>
            <p>🏠 Địa chỉ : Gần Đại Học Phenikaa, Hà Đông, Hà Nội</p>
            <p>📞 Điện thoại: 0965 XXX XXX</p>
            <p>✉️ Email: info@noithatxanh.com</p>
            <iframe class="mt-3 w-full h-32 rounded" src="https://www.google.com/maps/embed?pb=!1m18..."></iframe>
        </div>
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
        <div>
            <h3 class="text-xl font-bold mb-4">Theo dõi chúng tôi</h3>
            <div class="flex mt-4 space-x-3">
                <a href="https://facebook.com" target="_blank" class="hover:text-blue-500">FB</a>
                <a href="https://zalo.me" target="_blank" class="hover:text-blue-400">Zalo</a>
                <a href="https://www.tiktok.com" target="_blank" class="hover:text-pink-500">TikTok</a>
                <a href="https://www.instagram.com" target="_blank" class="hover:text-pink-400">IG</a>
            </div>
        </div>
    </div>
    <div class="text-center text-gray-200 mt-6">&copy; 2025 Nội Thất Xanh. Bản quyền thuộc Hưng Nguyễn.</div>
</footer>

<!-- ✅ Nút mở AI -->
<button onclick="toggleChat()" 
    class="fixed bottom-4 right-4 w-14 h-14 rounded-full bg-green-700 hover:bg-green-800 text-white flex items-center justify-center shadow-lg z-50">
    💬
</button>

<!-- ✅ Chat AI kiểu đối thoại -->
<div id="chatbox" class="fixed bottom-20 right-4 w-80 bg-white border rounded-lg shadow-lg z-50 hidden flex flex-col">
    <div class="bg-green-700 text-white px-4 py-2 flex justify-between items-center rounded-t-lg">
        <span>🤖 AI Tư vấn sản phẩm</span>
        <button onclick="toggleChat()" class="text-white font-bold">✖</button>
    </div>
    <div id="messages" class="h-64 overflow-y-auto p-3 text-sm flex flex-col gap-2"></div>
    <div class="flex border-t">
        <input id="chat-input" type="text" placeholder="Hỏi về sản phẩm..." class="flex-1 px-2 py-1 text-sm focus:outline-none">
        <button id="send-btn" class="bg-green-600 hover:bg-green-700 text-white px-3">Gửi</button>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
// Swiper
new Swiper(".mySwiperProducts",{slidesPerView:1,spaceBetween:15,loop:true,autoplay:{delay:3000},pagination:{el:".swiper-pagination",clickable:true},navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},breakpoints:{640:{slidesPerView:2},1024:{slidesPerView:3}}});

// Cart functions
function getCart(){return JSON.parse(localStorage.getItem('cart')||'[]');}
function saveCart(cart){localStorage.setItem('cart',JSON.stringify(cart)); renderCart();}
function renderCart(){let cart=getCart();let c=document.getElementById('cart-items');if(!c)return;if(cart.length===0){c.innerHTML='<p class="text-gray-500">Giỏ hàng trống</p>';document.getElementById('cart-total').innerText='0đ';return;}let html='';let total=0;cart.forEach((it,idx)=>{total+=it.price*it.quantity;html+=`<div class="flex justify-between mb-2"><div><div class="font-semibold">${it.name}</div><div class="text-sm">SL: ${it.quantity}</div></div><div><div class="font-bold text-red-600">${it.price.toLocaleString()}đ</div><div><button onclick="changeQuantity(${idx},-1)" class="px-2 bg-gray-200">-</button><button onclick="changeQuantity(${idx},1)" class="px-2 bg-gray-200">+</button></div></div></div>`});c.innerHTML=html;document.getElementById('cart-total').innerText=total.toLocaleString()+'đ';}
function changeQuantity(i,d){let c=getCart();if(!c[i])return;c[i].quantity+=d;if(c[i].quantity<=0)c.splice(i,1);saveCart(c);}
function toggleCart(){document.getElementById('cart-container').classList.toggle('hidden');}
function showProductDetail(n,d,img){document.getElementById('modal-name').innerText=n;document.getElementById('modal-desc').innerText=d;document.getElementById('modal-img').src=img;document.getElementById('productModal').classList.remove('hidden');document.getElementById('productModal').classList.add('flex');}
function closeProductModal(){document.getElementById('productModal').classList.add('hidden');}
function openProfileModal(){document.getElementById('profileModal').classList.remove('hidden');document.getElementById('profileModal').classList.add('flex');}
function closeProfileModal(){document.getElementById('profileModal').classList.add('hidden');}
function showNotify(msg,type='success'){const n=document.getElementById('notify');n.innerText=msg;n.style.background=type==='success'?'#16A34A':'#DC2626';n.classList.remove('opacity-0','translate-x-20');n.classList.add('opacity-100','translate-x-0');setTimeout(()=>{n.classList.remove('opacity-100','translate-x-0');n.classList.add('opacity-0','translate-x-20');},2500);}
function addToCart(id,name,price,img='/images/no-image.png'){let c=getCart();let it=c.find(i=>i.id===id);if(it)it.quantity++;else c.push({id,name,price,quantity:1,img});saveCart(c);showNotify(`Đã thêm "${name}" vào giỏ hàng!`);}
function goCheckout(){window.location.href="{{ route('checkout.show') }}";}
document.addEventListener('DOMContentLoaded', renderCart);

// ✅ Chat AI kiểu đối thoại
function toggleChat(){
    document.getElementById('chatbox').classList.toggle('hidden');
}

function appendMessage(sender, msg){
    let box = document.getElementById('messages');
    let html = '';
    if(sender==='user'){
        html = `<div class="flex justify-end">
                    <div class="bg-green-600 text-white px-3 py-1 rounded-lg max-w-[70%]">${msg}</div>
                </div>`;
    } else {
        html = `<div class="flex justify-start">
                    <div class="bg-gray-200 text-black px-3 py-1 rounded-lg max-w-[70%]">${msg}</div>
                </div>`;
    }
    box.innerHTML += html;
    box.scrollTop = box.scrollHeight;
}

document.getElementById('send-btn').addEventListener('click', function(){
    let input = document.getElementById('chat-input');
    let msg = input.value.trim();
    if(!msg) return;

    appendMessage('user', msg);

    fetch("{{ route('chat.ask') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({message: msg})
    }).then(res => res.json())
      .then(data => {
        appendMessage('ai', data.reply);
    });

    input.value = "";
});

document.getElementById('chat-input').addEventListener('keydown', function(e){
    if(e.key === 'Enter'){
        document.getElementById('send-btn').click();
        e.preventDefault();
    }
});
</script>

</body>
</html>
















