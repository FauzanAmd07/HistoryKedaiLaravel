@extends('layouts.dashboard')
@section('title', 'Manajemen Menu')
@section('content')
<div class="main-header">
    <h1>Manajemen Menu</h1>
    <a href="{{ route('menu.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Menu Baru</a>
</div>
<div class="table-container">
    <table>
        <thead><tr><th>Gambar</th><th>Nama Menu</th><th>Kategori</th><th>Harga</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($menus as $m)
        <tr>
            <td>
                @if($m->gambar && file_exists(public_path('storage/gambar/'.$m->gambar)))
                <img src="{{ asset('storage/gambar/'.$m->gambar) }}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                @else
                <div style="width:60px;height:60px;background:#F3F4F6;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#9CA3AF;"><i class="fas fa-image"></i></div>
                @endif
            </td>
            <td><strong>{{ $m->nama_menu }}</strong>@if($m->deskripsi)<br><small style="color:var(--color-text-muted)">{{ Str::limit($m->deskripsi, 50) }}</small>@endif</td>
            <td>{{ $m->kategori->nama_kategori }}</td>
            <td>Rp {{ number_format($m->harga, 0, ',', '.') }}</td>
            <td class="action-links">
                <a href="{{ route('menu.edit', $m) }}" class="btn-ubah"><i class="fas fa-edit"></i> Ubah</a>
                <button type="button" class="btn-hapus" onclick="konfirmasiHapus('{{ route('menu.destroy', $m) }}','{{ addslashes($m->nama_menu) }}')">
                    <i class="fas fa-archive"></i> Arsipkan
                </button>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;color:var(--color-text-muted);">Belum ada menu.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<form id="delete-form" method="POST" style="display:none">@csrf @method('DELETE')</form>
@endsection
@push('scripts')
<script>
function konfirmasiHapus(url, nama) {
    Swal.fire({ title: 'Arsipkan Menu?', html: `Yakin mengarsipkan menu <strong>${nama}</strong>?<br><small style="color:#6B7280">Menu tidak akan tampil di halaman pelanggan.</small>`, icon: 'warning', showCancelButton: true, confirmButtonColor: '#EF4444', cancelButtonColor: '#6B7280', confirmButtonText: '<i class="fas fa-archive"></i> Arsipkan!', cancelButtonText: 'Batal' }).then(r => { if (r.isConfirmed) { const f = document.getElementById('delete-form'); f.action = url; f.submit(); } });
}
</script>
@endpush
