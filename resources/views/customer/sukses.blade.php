@extends('layouts.app')
@section('title', 'Pesanan Berhasil - History Kedai')
@push('styles')
<style>
body{background:#F9FAFB;display:flex;align-items:center;justify-content:center;min-height:100vh;}
.card{background:white;padding:40px;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,0.08);text-align:center;max-width:450px;width:90%;margin:auto;}
.icon{width:80px;height:80px;background:#D1FAE5;color:#10B981;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:40px;margin:0 auto 20px;}
h1{margin:0 0 10px;color:#111827;font-family:'"'"'Poppins'"'"',sans-serif;}
p{color:#6B7280;margin:0 0 20px;line-height:1.6;}
.details{background:#F3F4F6;padding:20px;border-radius:10px;margin-bottom:25px;text-align:left;}
.row{display:flex;justify-content:space-between;margin-bottom:8px;}
.row:last-child{margin:0;border-top:1px dashed #ccc;padding-top:8px;font-weight:700;color:#6D28D9;}
.btn{display:block;padding:14px;background:#6D28D9;color:white;text-decoration:none;border-radius:50px;font-weight:600;font-family:'"'"'Poppins'"'"',sans-serif;transition:all 0.3s;}
.btn:hover{transform:translateY(-2px);box-shadow:0 5px 15px rgba(109,40,217,0.3);color:white;}
</style>
@endpush
@section('content')
<div class="card">
    <div class="icon"><i class="fas fa-check"></i></div>
    <h1>Pesanan Berhasil!</h1>
    <p>Terima kasih, <strong>{{ $pelanggan->nama }}</strong>. Pesanan Anda sedang diproses.</p>
    <div class="details">
        <div class="row"><span>Metode Bayar</span><strong>{{ $transaksi->metode_bayar }}</strong></div>
        <div class="row"><span>Total Tagihan</span><span>Rp {{ number_format($transaksi->total_harga,0,',','.') }}</span></div>
    </div>
    <p style="font-size:0.9em;">Silakan menuju kasir untuk pembayaran.</p>
    <a href="{{ route('home') }}" class="btn">Buat Pesanan Baru</a>
</div>
<script>sessionStorage.removeItem('cart');</script>
@endsection
