@extends('layouts.dashboard')
@section('title', 'Edit Menu')
@section('content')
<div class="main-header"><h1>Edit Menu</h1></div>
<div style="background:var(--color-surface);padding:2rem;border-radius:var(--border-radius);box-shadow:var(--shadow);max-width:700px;">
    @if($errors->any())<div class="alert alert-danger">@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif
    <form action="{{ route('menu.update', $menu) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;">
            <div><label style="display:block;font-weight:500;margin-bottom:6px;">Nama Menu</label><input type="text" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" required style="width:100%;padding:10px;border:1px solid #D1D5DB;border-radius:8px;font-family:inherit;font-size:1rem;"></div>
            <div><label style="display:block;font-weight:500;margin-bottom:6px;">Harga (Rp)</label><input type="number" name="harga" value="{{ old('harga', $menu->harga) }}" required min="0" style="width:100%;padding:10px;border:1px solid #D1D5DB;border-radius:8px;font-family:inherit;font-size:1rem;"></div>
            <div><label style="display:block;font-weight:500;margin-bottom:6px;">Kategori</label><select name="id_kategori" required style="width:100%;padding:10px;border:1px solid #D1D5DB;border-radius:8px;font-family:inherit;font-size:1rem;">@foreach($kategoris as $k)<option value="{{ $k->id_kategori }}" {{ $menu->id_kategori==$k->id_kategori?'selected':'' }}>{{ $k->nama_kategori }}</option>@endforeach</select></div>
            <div>
                <label style="display:block;font-weight:500;margin-bottom:6px;">Gambar Baru</label>
                @if($menu->gambar)<img src="{{ asset('storage/gambar/'.$menu->gambar) }}" style="width:80px;height:80px;object-fit:cover;border-radius:8px;display:block;margin-bottom:8px;">@endif
                <input type="file" name="gambar" accept="image/*" style="width:100%;padding:8px;border:1px solid #D1D5DB;border-radius:8px;font-family:inherit;font-size:0.9rem;">
            </div>
        </div>
        <div style="margin:1.2rem 0;"><label style="display:block;font-weight:500;margin-bottom:6px;">Deskripsi</label><textarea name="deskripsi" rows="3" style="width:100%;padding:10px;border:1px solid #D1D5DB;border-radius:8px;font-family:inherit;font-size:1rem;resize:vertical;">{{ old('deskripsi', $menu->deskripsi) }}</textarea></div>
        <div style="display:flex;gap:10px;"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Perbarui</button><a href="{{ route('menu.index') }}" class="btn" style="background:#F3F4F6;color:#374151;">Batal</a></div>
    </form>
</div>
@endsection
