@extends('layouts.dashboard')
@section('title', 'Detail Transaksi #'.$transaksi->id_transaksi)
@section('content')
<div class="main-header">
    <h1>Detail Transaksi #{{ $transaksi->id_transaksi }}</h1>
    <a href="{{ url()->previous() }}" class="btn" style="background:#F3F4F6;color:#374151;"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
    <div style="background:var(--color-surface);padding:1.5rem;border-radius:var(--border-radius);box-shadow:var(--shadow);">
        <h3 style="margin:0 0 1rem;">Informasi Pesanan</h3>
        <table style="width:100%;border-collapse:collapse;">
            <tr><td style="padding:6px 0;color:var(--color-text-muted);width:40%;">Pelanggan</td><td style="padding:6px 0;font-weight:500;">{{ $transaksi->pelanggan->nama }}</td></tr>
            <tr><td style="padding:6px 0;color:var(--color-text-muted);">Tanggal</td><td style="padding:6px 0;">{{ $transaksi->tanggal->format('d M Y, H:i') }} WITA</td></tr>
            <tr><td style="padding:6px 0;color:var(--color-text-muted);">Metode Bayar</td><td style="padding:6px 0;">{{ $transaksi->metode_bayar }}</td></tr>
            <tr><td style="padding:6px 0;color:var(--color-text-muted);">Status</td><td style="padding:6px 0;"><span class="badge badge-{{ Str::slug($transaksi->status) }}">{{ $transaksi->status }}</span></td></tr>
            <tr><td style="padding:6px 0;color:var(--color-text-muted);">Total</td><td style="padding:6px 0;font-weight:700;color:#6D28D9;font-size:1.2rem;">Rp {{ number_format($transaksi->total_harga,0,',','.') }}</td></tr>
        </table>
    </div>
    <div style="background:var(--color-surface);padding:1.5rem;border-radius:var(--border-radius);box-shadow:var(--shadow);">
        <h3 style="margin:0 0 1rem;">Item Pesanan</h3>
        @foreach($transaksi->details as $d)
        <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #F3F4F6;">
            <span>{{ $d->menu->nama_menu }} <span style="color:var(--color-text-muted);">x{{ $d->jumlah }}</span></span>
            <strong>Rp {{ number_format($d->subtotal,0,',','.') }}</strong>
        </div>
        @endforeach
        <div style="display:flex;justify-content:space-between;padding:12px 0;font-size:1.1rem;font-weight:700;">
            <span>Total</span>
            <span style="color:#6D28D9;">Rp {{ number_format($transaksi->total_harga,0,',','.') }}</span>
        </div>
    </div>
</div>
@endsection
