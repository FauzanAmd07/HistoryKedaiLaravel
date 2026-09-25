@extends('layouts.dashboard')
@section('title', 'Pesanan Masuk')
@section('content')
<div class="main-header"><h1>Pesanan Masuk</h1></div>
@if($pesanans->isEmpty())
<div style="text-align:center;padding:60px;background:var(--color-surface);border-radius:var(--border-radius);box-shadow:var(--shadow);">
    <i class="fas fa-inbox" style="font-size:3rem;color:#D1D5DB;margin-bottom:1rem;display:block;"></i>
    <h3 style="color:var(--color-text-muted);">Tidak ada pesanan baru</h3>
</div>
@else
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:20px;">
@foreach($pesanans as $p)
<div style="background:var(--color-surface);border-radius:var(--border-radius);box-shadow:var(--shadow);padding:1.5rem;border-left:4px solid {{ $p->status=='Baru Masuk'?'#F59E0B':'#3B82F6' }};">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
        <strong>#{{ $p->id_transaksi }}</strong>
        <span class="badge {{ $p->status=='Baru Masuk'?'badge-baru':'badge-proses' }}">{{ $p->status }}</span>
    </div>
    <div style="margin-bottom:0.5rem;"><i class="fas fa-user" style="color:var(--color-text-muted);width:18px;"></i> {{ $p->pelanggan->nama }}</div>
    <div style="margin-bottom:0.5rem;"><i class="fas fa-clock" style="color:var(--color-text-muted);width:18px;"></i> {{ $p->tanggal->format('H:i') }}</div>
    <div style="margin-bottom:1rem;"><i class="fas fa-money-bill" style="color:var(--color-text-muted);width:18px;"></i> Rp {{ number_format($p->total_harga,0,',','.') }} ({{ $p->metode_bayar }})</div>
    <div style="display:flex;gap:8px;flex-wrap:wrap;">
        <a href="{{ route('dashboard.riwayat.detail', $p) }}" class="btn" style="background:#DBEAFE;color:#1E40AF;padding:6px 12px;font-size:0.85em;"><i class="fas fa-eye"></i> Detail</a>
        @if($p->status == 'Baru Masuk')
        <form action="{{ route('dashboard.pesanan.status', $p) }}" method="POST" style="margin:0">
            @csrf @method('PATCH') <input type="hidden" name="status" value="Sedang Diproses">
            <button type="submit" class="btn" style="background:#FEF3C7;color:#92400E;padding:6px 12px;font-size:0.85em;border:none;cursor:pointer;font-family:inherit;"><i class="fas fa-play"></i> Proses</button>
        </form>
        @endif
        @if(in_array($p->status, ['Baru Masuk', 'Sedang Diproses']))
        <form action="{{ route('dashboard.pesanan.status', $p) }}" method="POST" style="margin:0">
            @csrf @method('PATCH') <input type="hidden" name="status" value="Selesai">
            <button type="submit" class="btn" style="background:#D1FAE5;color:#065F46;padding:6px 12px;font-size:0.85em;border:none;cursor:pointer;font-family:inherit;"><i class="fas fa-check"></i> Selesai</button>
        </form>
        @endif
    </div>
</div>
@endforeach
</div>
@endif
@endsection
