@extends('layouts.app')
@section('title', 'Checkout - History Kedai')
@push('styles')
<style>
:root{--color-primary:#6D28D9;--color-secondary:#8B5CF6;--font-body:'"'"'Poppins'"'"',sans-serif;--border-radius:16px;}
body{background:#F9F9FD;}
.header{background:white;padding:1rem 4rem;box-shadow:0 4px 12px rgba(0,0,0,0.05);}
.header a{text-decoration:none;color:var(--color-secondary);font-weight:600;}
.container{max-width:600px;margin:50px auto;padding:40px;background:white;box-shadow:0 10px 40px rgba(0,0,0,0.08);border-radius:var(--border-radius);}
h2{text-align:center;font-size:2.5em;color:var(--color-primary);margin:0 0 30px;}
.form-group{margin-bottom:25px;}
.form-group label{display:block;margin-bottom:8px;font-weight:500;}
.form-group input[type="text"]{width:100%;padding:12px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;font-family:var(--font-body);font-size:1em;}
.payment-grid{display:grid;grid-template-columns:1fr 1fr;gap:15px;}
.payment-item input{display:none;}
.payment-item label{display:flex;align-items:center;gap:10px;padding:18px;border:2px solid #eee;border-radius:var(--border-radius);cursor:pointer;transition:all 0.2s;}
.payment-item input:checked+label{border-color:var(--color-secondary);background:#F9F9FD;}
.payment-item i{font-size:1.5em;color:#9CA3AF;}
.payment-item input:checked+label i{color:var(--color-secondary);}
#qris-display{text-align:center;margin-top:20px;opacity:0;max-height:0;overflow:hidden;transition:all 0.5s;}
#qris-display.show{opacity:1;max-height:300px;}
#qris-display img{max-width:200px;border-radius:10px;}
.summary-box{background:#F9F9FD;padding:20px;border-radius:var(--border-radius);margin-top:25px;}
#summary-total{font-size:1.4em;font-weight:bold;text-align:right;margin-top:15px;border-top:2px solid #E6E0FF;padding-top:12px;color:var(--color-primary);}
.cta-button{display:block;width:100%;padding:1rem;background:var(--color-secondary);color:white;text-align:center;font-size:1.2em;font-weight:600;border-radius:50px;margin-top:25px;transition:all 0.3s;border:none;cursor:pointer;font-family:var(--font-body);}
.cta-button:hover{transform:translateY(-3px);box-shadow:0 5px 20px rgba(109,40,217,0.3);}
</style>
@endpush
@section('content')
<header class="header"><a href="{{ route('keranjang') }}"><i class="fas fa-arrow-left"></i> Kembali ke Keranjang</a></header>
<div class="container">
    <h2>Konfirmasi Pesanan</h2>
    <form action="{{ route('pesan.proses') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_pelanggan">Nama Anda</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" placeholder="Tulis nama Anda di sini..." required>
        </div>
        <div class="form-group">
            <label>Metode Pembayaran</label>
            <div class="payment-grid">
                <div class="payment-item"><input type="radio" id="tunai" name="metode_bayar" value="Tunai" checked><label for="tunai"><i class="fas fa-money-bill-wave"></i><span>Tunai</span></label></div>
                <div class="payment-item"><input type="radio" id="qris" name="metode_bayar" value="QRIS"><label for="qris"><i class="fas fa-qrcode"></i><span>QRIS</span></label></div>
            </div>
        </div>
        <div id="qris-display"><p>Scan kode QRIS berikut:</p><img src="{{ asset('images/qris.jpg') }}" alt="QRIS"></div>
        <div class="summary-box">
            <strong>Ringkasan Pesanan</strong>
            <div id="summary-items" style="margin-top:15px;"></div>
            <div id="summary-total">Total: Rp 0</div>
        </div>
        <input type="hidden" name="pesanan_json" id="pesanan_json_input">
        <input type="hidden" name="total_harga" id="total_harga_input">
        <button type="submit" class="cta-button">Buat Pesanan Sekarang</button>
    </form>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cart = JSON.parse(sessionStorage.getItem('cart')) || {};
    const summaryItems = document.getElementById('summary-items');
    const summaryTotal = document.getElementById('summary-total');
    let total = 0; let items = [];
    summaryItems.innerHTML = '';
    for (const id in cart) {
        const item = cart[id]; const sub = item.price * item.qty; total += sub;
        summaryItems.innerHTML += `<div style="display:flex;justify-content:space-between;margin-bottom:8px;color:#6B7280"><span>${item.qty}x ${item.name}</span><span>Rp ${sub.toLocaleString('id-ID')}</span></div>`;
        items.push({id, name: item.name, price: item.price, qty: item.qty});
    }
    summaryTotal.innerText = 'Total: Rp ' + total.toLocaleString('id-ID');
    document.getElementById('pesanan_json_input').value = JSON.stringify(items);
    document.getElementById('total_harga_input').value = total;
    document.querySelectorAll('input[name="metode_bayar"]').forEach(r => r.addEventListener('change', function() {
        document.getElementById('qris-display').classList.toggle('show', this.value === 'QRIS');
    }));
});
</script>
@endpush
