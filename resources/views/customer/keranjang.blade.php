@extends('layouts.app')
@section('title', 'Keranjang - History Kedai')
@push('styles')
<style>
:root{--color-primary:#6D28D9;--color-secondary:#8B5CF6;--color-white:#fff;--color-light-bg:#F9FAFB;--color-dark-text:#111827;--color-muted-text:#6B7280;--font-heading:'"'"'Syne'"'"',sans-serif;--font-body:'"'"'Poppins'"'"',sans-serif;--border-radius:16px;}
body{background-color:var(--color-light-bg);}
.header{background:white;padding:1rem 4rem;box-shadow:0 4px 12px rgba(0,0,0,0.05);display:flex;justify-content:space-between;align-items:center;}
.header a{text-decoration:none;color:var(--color-secondary);font-weight:600;transition:color 0.3s;}
.header a:hover{color:var(--color-primary);}
.container{max-width:900px;margin:50px auto;padding:40px;background:white;box-shadow:0 10px 40px rgba(0,0,0,0.08);border-radius:var(--border-radius);}
h2{font-family:var(--font-heading);text-align:center;font-size:2.5em;color:var(--color-primary);margin:0 0 40px;}
table{width:100%;border-collapse:collapse;}
th,td{padding:15px;text-align:left;border-bottom:1px solid #eee;vertical-align:middle;}
thead th{color:var(--color-muted-text);font-size:0.9em;text-transform:uppercase;}
.qty-input{width:60px;text-align:center;padding:8px;border:1px solid #ddd;border-radius:5px;font-size:1em;}
.btn-hapus{background:none;border:none;color:#ccc;font-size:1.2em;cursor:pointer;transition:color 0.3s;}
.btn-hapus:hover{color:#dc3545;}
.summary{margin-top:40px;text-align:right;border-top:2px solid #E6E0FF;padding-top:20px;}
.total-price{font-size:2em;font-weight:700;color:var(--color-primary);}
.cta-button{display:block;width:100%;padding:1rem;background:var(--color-secondary);color:white;text-decoration:none;text-align:center;font-size:1.2em;font-weight:600;border-radius:50px;margin-top:25px;transition:all 0.3s;border:none;font-family:var(--font-body);cursor:pointer;}
.cta-button:hover{transform:translateY(-3px);box-shadow:0 5px 20px rgba(109,40,217,0.3);color:white;}
.cart-empty{text-align:center;padding:50px;}
</style>
@endpush
@section('content')
<header class="header">
    <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Kembali ke Menu</a>
    <a href="{{ route('login') }}">Login Karyawan</a>
</header>
<div class="container">
    <h2>Keranjang Anda</h2>
    <div id="cart-items"><table><thead><tr><th>Menu</th><th>Harga</th><th style="text-align:center">Jumlah</th><th>Subtotal</th><th></th></tr></thead><tbody></tbody></table></div>
    <div class="summary"><div id="total-price" class="total-price">Rp 0</div></div>
    <a href="{{ route('checkout') }}" id="checkout-btn" class="cta-button">Lanjutkan ke Pembayaran</a>
</div>
@endsection
@push('scripts')
<script>
function renderCart() {
    const cart = JSON.parse(sessionStorage.getItem('cart')) || {};
    const tbody = document.querySelector('#cart-items tbody');
    const main = document.querySelector('.container');
    tbody.innerHTML = ''; let total = 0;
    if (!Object.keys(cart).length) {
        main.innerHTML = '<div class="cart-empty"><h2>Keranjang Kosong</h2><p>Silakan pilih menu favorit Anda.</p><a href="'+`{{ route('home') }}`+'" class="cta-button" style="width:auto;display:inline-block;padding:15px 30px;">Kembali ke Menu</a></div>';
        return;
    }
    for (const id in cart) {
        const item = cart[id]; const sub = item.price * item.qty; total += sub;
        const tr = document.createElement('tr');
        tr.innerHTML = `<td><strong>${item.name}</strong><br><small style="color:#6B7280">@ Rp ${item.price.toLocaleString('id-ID')}</small></td><td>Rp ${item.price.toLocaleString('id-ID')}</td><td style="text-align:center"><input type="number" class="qty-input" value="${item.qty}" min="1" onchange="updateQty(${id},this.value)"></td><td><strong>Rp ${sub.toLocaleString('id-ID')}</strong></td><td><button class="btn-hapus" onclick="removeFromCart(${id})"><i class="fas fa-times"></i></button></td>`;
        tbody.appendChild(tr);
    }
    document.getElementById('total-price').innerText = 'Total: Rp ' + total.toLocaleString('id-ID');
}
function updateQty(id, qty) { let c = JSON.parse(sessionStorage.getItem('cart'))||{}; if(c[id]){c[id].qty=parseInt(qty)||1; if(c[id].qty<=0)delete c[id]; sessionStorage.setItem('cart',JSON.stringify(c)); renderCart();} }
function removeFromCart(id) { let c = JSON.parse(sessionStorage.getItem('cart'))||{}; delete c[id]; sessionStorage.setItem('cart',JSON.stringify(c)); renderCart(); }
document.addEventListener('DOMContentLoaded', renderCart);
</script>
@endpush
