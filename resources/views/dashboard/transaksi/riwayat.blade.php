@extends('layouts.dashboard')
@section('title', 'Riwayat Transaksi')
@section('content')
<div class="main-header"><h1>Riwayat Transaksi</h1></div>
<div class="table-container">
    <table>
        <thead><tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Total</th><th>Metode</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($transaksis as $t)
        <tr>
            <td>#{{ $t->id_transaksi }}</td>
            <td>{{ $t->tanggal->format('d/m/Y H:i') }}</td>
            <td>{{ $t->pelanggan->nama }}</td>
            <td>Rp {{ number_format($t->total_harga,0,',','.') }}</td>
            <td>{{ $t->metode_bayar }}</td>
            <td><span class="badge badge-{{ Str::slug($t->status) }}">{{ $t->status }}</span></td>
            <td><a href="{{ route('dashboard.riwayat.detail', $t) }}" class="btn-ubah"><i class="fas fa-eye"></i> Detail</a></td>
        </tr>
        @empty
        <tr><td colspan="7" style="text-align:center;color:var(--color-text-muted);">Belum ada riwayat transaksi.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:1rem;">{{ $transaksis->links() }}</div>
@endsection
