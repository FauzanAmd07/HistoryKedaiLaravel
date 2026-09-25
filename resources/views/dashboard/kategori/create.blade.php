@extends('layouts.dashboard')
@section('title', 'Tambah Kategori')
@section('content')
<div class="main-header"><h1>Tambah Kategori</h1></div>
<div style="background:var(--color-surface);padding:2rem;border-radius:var(--border-radius);box-shadow:var(--shadow);max-width:500px;">
    @if($errors->any())<div class="alert alert-danger">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif
    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div style="margin-bottom:1.5rem;"><label style="display:block;font-weight:500;margin-bottom:6px;">Nama Kategori</label><input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" required placeholder="Contoh: Minuman Panas" style="width:100%;padding:10px;border:1px solid #D1D5DB;border-radius:8px;font-family:inherit;font-size:1rem;"></div>
        <div style="display:flex;gap:10px;"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button><a href="{{ route('kategori.index') }}" class="btn" style="background:#F3F4F6;color:#374151;">Batal</a></div>
    </form>
</div>
@endsection
