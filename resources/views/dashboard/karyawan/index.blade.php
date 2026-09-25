@extends('layouts.dashboard')
@section('title', 'Manajemen Karyawan')
@section('content')
<div class="main-header">
    <h1>Manajemen Karyawan</h1>
    <a href="{{ route('karyawan.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Karyawan</a>
</div>
<div class="table-container">
    <table>
        <thead><tr><th>ID</th><th>Nama</th><th>Username</th><th>Jabatan</th><th>Aksi</th></tr></thead>
        <tbody>
        @forelse($karyawans as $k)
        <tr>
            <td>{{ $k->id_karyawan }}</td>
            <td>{{ $k->nama }}</td>
            <td>{{ $k->username }}</td>
            <td><span class="badge" style="background:#DBEAFE;color:#1E40AF;">{{ $k->jabatan }}</span></td>
            <td class="action-links">
                <a href="{{ route('karyawan.edit', $k) }}" class="btn-ubah"><i class="fas fa-edit"></i> Ubah</a>
                <button type="button" class="btn-hapus" onclick="konfirmasiHapus('{{ route('karyawan.destroy', $k) }}','{{ $k->nama }}')">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;color:var(--color-text-muted);">Belum ada data karyawan.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<form id="delete-form" method="POST" style="display:none">@csrf @method('DELETE')</form>
@endsection
@push('scripts')
<script>
function konfirmasiHapus(url, nama) {
    Swal.fire({ title: 'Hapus Karyawan?', html: `Yakin menonaktifkan <strong>${nama}</strong>?`, icon: 'warning', showCancelButton: true, confirmButtonColor: '#EF4444', cancelButtonColor: '#6B7280', confirmButtonText: '<i class="fas fa-trash"></i> Ya, Nonaktifkan!', cancelButtonText: 'Batal' }).then(r => { if (r.isConfirmed) { const f = document.getElementById('delete-form'); f.action = url; f.submit(); } });
}
</script>
@endpush
