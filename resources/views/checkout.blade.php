<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thanh toán - Nội Thất Xanh</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
/* animation cho card giỏ hàng */
@keyframes fadeInUp {
  0% { opacity: 0; transform: translateY(20px); }
  100% { opacity: 1; transform: translateY(0); }
}
.cart-item { animation: fadeInUp 0.4s ease forwards; }
</style>
</head>
<body class="bg-gray-100 font-sans">

<header class="bg-green-700 text-white py-4 shadow">
  <div class="container mx-auto px-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold">🏠 Nội Thất Xanh</h1>
    <a href="{{ route('home') }}" class="bg-yellow-400 text-green-900 px-3 py-1 rounded hover:bg-yellow-500">Trang chủ</a>
  </div>
</header>

<main class="container mx-auto px-6 py-10">

  <h2 class="text-3xl font-bold text-green-900 mb-6 text-center">Giỏ hàng của bạn</h2>

  <div id="cart-items" class="grid grid-cols-1 md:grid-cols-2 gap-6"></div>

  <div class="mt-6 sticky top-6 bg-white p-6 rounded-lg shadow max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-4">
      <span class="font-bold text-xl">Tổng tiền:</span>
      <span id="cart-total" class="font-bold text-xl text-red-600">0đ</span>
    </div>

    <label class="block mb-2 font-semibold">Chọn phương thức thanh toán:</label>
    <select id="payment-method" class="w-full border px-3 py-2 rounded mb-4">
      <option value="cod">COD</option>
      <option value="bank">Chuyển khoản</option>
      <option value="momo">Ví Momo</option>
      <option value="paypal">PayPal</option>
    </select>

    <button id="checkout-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full transition-all duration-200">Thanh toán</button>

    <div id="payment-info" class="mt-4 p-4 rounded shadow text-white hidden"></div>
  </div>

</main>

<script>
function getCart(){return JSON.parse(localStorage.getItem('cart')||'[]');}
function saveCart(cart){localStorage.setItem('cart',JSON.stringify(cart));renderCart();}

function renderCart(){
  let cart=getCart();
  let container=document.getElementById('cart-items');
  if(cart.length===0){
    container.innerHTML='<p class="text-gray-500 col-span-full text-center">Giỏ hàng trống</p>';
    document.getElementById('cart-total').innerText='0đ';
    return;
  }
  let html='';
  let total=0;
  cart.forEach((it,idx)=>{
    total+=it.price*it.quantity;
    html+=`
    <div class="cart-item bg-white rounded-lg shadow p-4 hover:shadow-xl transition transform hover:scale-105 flex gap-4">
      <img src="${it.img || '/images/no-image.png'}" class="w-24 h-24 object-cover rounded">
      <div class="flex-1 flex flex-col justify-between">
        <div>
          <div class="text-lg font-semibold text-green-900 mb-1">${it.name}</div>
          <div class="text-gray-600 mb-1">Số lượng: ${it.quantity}</div>
          <div class="font-bold text-red-600 mb-1">${it.price.toLocaleString()}đ</div>
        </div>
        <div class="flex gap-2 mt-2">
          <button onclick="changeQuantity(${idx},-1)" class="px-2 bg-gray-200 rounded hover:bg-gray-300">-</button>
          <button onclick="changeQuantity(${idx},1)" class="px-2 bg-gray-200 rounded hover:bg-gray-300">+</button>
          <button onclick="removeItem(${idx})" class="px-2 bg-red-500 text-white rounded hover:bg-red-600 flex-1">Xóa</button>
        </div>
      </div>
    </div>
    `;
  });
  container.innerHTML=html;
  document.getElementById('cart-total').innerText=total.toLocaleString()+'đ';
}

function changeQuantity(index,delta){
  let cart=getCart();
  if(!cart[index]) return;
  cart[index].quantity+=delta;
  if(cart[index].quantity<=0) cart.splice(index,1);
  saveCart(cart);
}
function removeItem(index){
  let cart=getCart();
  if(!cart[index]) return;
  cart.splice(index,1);
  saveCart(cart);
}

document.getElementById('checkout-btn').addEventListener('click',function(){
  let cart=getCart();
  if(cart.length===0){alert('Giỏ hàng trống'); return;}
  let method=document.getElementById('payment-method').value;

  let infoBox=document.getElementById('payment-info');
  infoBox.innerHTML=''; infoBox.classList.add('hidden');

  switch(method){
    case 'cod': 
      infoBox.innerHTML=`<p class="font-bold">Bạn sẽ thanh toán khi nhận hàng (COD).</p>`;
      infoBox.style.background='linear-gradient(135deg,#34D399,#059669)'; 
      break;
    case 'bank': 
      infoBox.innerHTML=`
        <p class="font-bold">Chuyển khoản ngân hàng:</p>
        <p>Ngân hàng: MBBank</p>
        <p>Số tài khoản: <b>0972394123</b></p>
        <p>Chủ tài khoản: <b>Nguyễn Tường Hưng</b></p>
        <img src="/images/anhqr.jpg" class="w-48 mt-2 border rounded">
      `;
      infoBox.style.background='linear-gradient(135deg,#2563EB,#1D4ED8)';
      break;
    case 'momo': 
      infoBox.innerHTML=`
        <p class="font-bold">Thanh toán qua ví Momo:</p>
        <p>SĐT: <b>0901234567</b></p>
        <img src="/images/qrmomo.png" class="w-48 mt-2 border rounded">
      `;
      infoBox.style.background='linear-gradient(135deg,#FBBF24,#F59E0B)';
      break;
    case 'paypal': 
      infoBox.innerHTML=`
        <p class="font-bold">Thanh toán qua PayPal:</p>
        <p>Email: <b>hungpaypal@example.com</b></p>
        <img src="/images/qrpaypal.png" class="w-48 mt-2 border rounded">
      `;
      infoBox.style.background='linear-gradient(135deg,#0EA5E9,#0369A1)';
      break;
  }

  infoBox.classList.remove('hidden');

  // gửi đơn hàng
  fetch("{{ route('checkout') }}",{
    method:'POST',
    headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
    body:JSON.stringify({cart,payment_method:method})
  })
  .then(res=>res.json())
  .then(data=>{
    if(data.success){
      alert('Đặt hàng thành công (Mã: '+data.order_id+')');
      localStorage.removeItem('cart');
      renderCart();
      // chuyển sang trang thanh toán chi tiết (nếu có link)
      if(data.redirect) window.location.href=data.redirect;
    } else { alert(data.error||'Có lỗi xảy ra'); }
  })
  .catch(e=>{ console.error(e); alert('Lỗi kết nối'); });
});

document.addEventListener('DOMContentLoaded',renderCart);
</script>

</body>
</html>




