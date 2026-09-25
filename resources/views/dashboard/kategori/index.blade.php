@extends('layouts.dashboard')
@section('title', 'Manajemen Kategori')
@section('content')
<div class="main-header">
    <h1>Manajemen Kategori</h1>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Kategori</a>
</div>
<div class="table-container" style="max-width:700px;">
    <table>
        <thead><tr><th>No</th><th>Nama Kategori</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($kategoris as $i => $k)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $k->nama_kategori }}</td>
            <td class="action-links">
                <a href="{{ route('kategori.edit', $k) }}" class="btn-ubah"><i class="fas fa-edit"></i> Ubah</a>
                <button type="button" class="btn-hapus" onclick="konfirmasiHapus('{{ route('kategori.destroy', $k) }}','{{ $k->nama_kategori }}')">
                    <i class="fas fa-archive"></i> Arsipkan
                </button>
            </td>
        </tr>
        @empty
        <tr><td colspan="3" style="text-align:center;color:var(--color-text-muted);">Belum ada kategori.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<form id="delete-form" method="POST" style="display:none">@csrf @method('DELETE')</form>
@endsection
@push('scripts')
<script>
function konfirmasiHapus(url, nama) {
    Swal.fire({ title: 'Arsipkan Kategori?', html: `Yakin mengarsipkan <strong>${nama}</strong>?<br><small style="color:#6B7280">Menu dalam kategori ini ikut diarsipkan.</small>`, icon: 'warning', showCancelButton: true, confirmButtonColor: '#EF4444', cancelButtonColor: '#6B7280', confirmButtonText: '<i class="fas fa-archive"></i> Arsipkan!', cancelButtonText: 'Batal' }).then(r => { if (r.isConfirmed) { const f = document.getElementById('delete-form'); f.action = url; f.submit(); } });
}
</script>
@endpush
