@extends('layouts.dashboard')
@section('title', 'Laporan Penjualan')
@section('content')
<div class="main-header"><h1>Laporan Penjualan</h1></div>
<div style="background:var(--color-surface);padding:2rem;border-radius:var(--border-radius);box-shadow:var(--shadow);max-width:500px;">
    <form action="{{ route('dashboard.laporan.export') }}" method="GET">
        <div style="margin-bottom:1.5rem;">
            <label style="display:block;font-weight:500;margin-bottom:8px;">Pilih Bulan & Tahun</label>
            <input type="month" name="bulan" value="{{ now()->format('Y-m') }}" style="width:100%;padding:10px;border:1px solid #D1D5DB;border-radius:8px;font-family:inherit;font-size:1rem;">
        </div>
        <button type="submit" class="btn btn-success"><i class="fas fa-file-excel"></i> Download Laporan CSV</button>
    </form>
</div>
@endsection
