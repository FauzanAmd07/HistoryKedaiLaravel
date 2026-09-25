@extends('layouts.dashboard')
@section('title', 'Tambah Karyawan')
@section('content')
<div class="main-header"><h1>Tambah Karyawan</h1></div>
<div style="background:var(--color-surface);padding:2rem;border-radius:var(--border-radius);box-shadow:var(--shadow);max-width:600px;">
    @if($errors->any())<div class="alert alert-danger">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif
    <form action="{{ route('karyawan.store') }}" method="POST">
        @csrf
        <div style="margin-bottom:1.2rem;"><label style="display:block;font-weight:500;margin-bottom:6px;">Nama Lengkap</label><input type="text" name="nama" value="{{ old('nama') }}" required style="width:100%;padding:10px;border:1px solid #D1D5DB;border-radius:8px;font-family:inherit;font-size:1rem;"></div>
        <div style="margin-bottom:1.2rem;"><label style="display:block;font-weight:500;margin-bottom:6px;">Username</label><input type="text" name="username" value="{{ old('username') }}" required style="width:100%;padding:10px;border:1px solid #D1D5DB;border-radius:8px;font-family:inherit;font-size:1rem;"></div>
        <div style="margin-bottom:1.2rem;"><label style="display:block;font-weight:500;margin-bottom:6px;">Password</label><input type="password" name="password" required style="width:100%;padding:10px;border:1px solid #D1D5DB;border-radius:8px;font-family:inherit;font-size:1rem;"></div>
        <div style="margin-bottom:1.5rem;"><label style="display:block;font-weight:500;margin-bottom:6px;">Jabatan</label><select name="jabatan" required style="width:100%;padding:10px;border:1px solid #D1D5DB;border-radius:8px;font-family:inherit;font-size:1rem;"><option value="">-- Pilih --</option><option value="Admin" {{ old('jabatan')=='Admin'?'selected':'' }}>Admin</option><option value="Kasir" {{ old('jabatan')=='Kasir'?'selected':'' }}>Kasir</option></select></div>
        <div style="display:flex;gap:10px;"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button><a href="{{ route('karyawan.index') }}" class="btn" style="background:#F3F4F6;color:#374151;">Batal</a></div>
    </form>
</div>
@endsection
