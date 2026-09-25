<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - HistoryKedai</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* === DESIGN SYSTEM TOKENS (Sesuai README - Modul Dashboard) === */
        :root {
            --color-blue-primary: #3B82F6;   /* Biru Utama */
            --color-blue-secondary: #BFDBFE; /* Biru Muda / Highlight Menu Active */
            --color-blue-dark: #1E40AF;      /* Biru Gelap / Header Text */
            --color-bg: #F3F4F6;             /* Background Halaman */
            --color-surface: #FFFFFF;         /* Surface Card & Table */
            --color-text-dark: #1F2937;       /* Teks Gelap */
            --color-text-muted: #6B7280;      /* Teks Muted */
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --font-body: 'Poppins', sans-serif;
            --color-success: #10B981;
            --color-warning: #F59E0B;
            --color-danger: #EF4444;
        }
        * { box-sizing: border-box; }
        body { font-family: var(--font-body); margin: 0; background-color: var(--color-bg); color: var(--color-text-dark); display: flex; }
        .sidebar { width: 250px; background: var(--color-surface); min-height: 100vh; padding: 2rem 1rem; display: flex; flex-direction: column; border-right: 1px solid #E5E7EB; position: fixed; top: 0; left: 0; overflow-y: auto; z-index: 100; }
        .sidebar .logo { font-weight: 700; font-size: 1.5rem; color: var(--color-blue-dark); margin-bottom: 2rem; text-align: center; padding: 0.5rem; }
        .sidebar-nav a { display: flex; align-items: center; gap: 10px; padding: 0.9rem 1.2rem; text-decoration: none; color: var(--color-text-muted); font-weight: 500; border-radius: 8px; margin-bottom: 0.4rem; transition: all 0.2s ease; }
        .sidebar-nav a:hover, .sidebar-nav a.active { background-color: var(--color-blue-secondary); color: var(--color-blue-dark); }
        .sidebar-nav a .icon { width: 20px; text-align: center; }
        .user-profile { margin-top: auto; display: flex; align-items: center; gap: 10px; padding: 1rem; border-top: 1px solid #E5E7EB; }
        .user-profile .avatar { width: 40px; height: 40px; border-radius: 50%; background: var(--color-blue-primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; flex-shrink: 0; }
        .user-profile .name { font-weight: 600; font-size: 0.95em; }
        .user-profile .role { font-size: 0.78em; color: var(--color-text-muted); }
        .logout-btn { color: var(--color-danger); text-decoration: none; margin-left: auto; font-size: 1.2em; transition: opacity 0.2s; }
        .logout-btn:hover { opacity: 0.7; }
        .main-content { margin-left: 250px; flex-grow: 1; padding: 2rem; min-height: 100vh; }
        .main-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
        .main-header h1 { margin: 0; font-size: 1.8rem; }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 0.7rem 1.2rem; border-radius: 8px; text-decoration: none; font-weight: 500; transition: all 0.2s ease; border: none; cursor: pointer; font-family: var(--font-body); font-size: 1rem; }
        .btn-primary { background-color: var(--color-blue-primary); color: white; }
        .btn-primary:hover { background-color: var(--color-blue-dark); color: white; }
        .btn-success { background-color: var(--color-success); color: white; }
        .btn-success:hover { background-color: #059669; }
        .table-container { background: var(--color-surface); border-radius: var(--border-radius); box-shadow: var(--shadow); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 1rem; text-align: left; border-bottom: 1px solid #E5E7EB; }
        thead th { background-color: #F9FAFB; color: var(--color-text-muted); font-weight: 600; font-size: 0.85em; text-transform: uppercase; letter-spacing: 0.5px; }
        tbody tr:hover { background-color: #F9FAFB; }
        tbody tr:last-child td { border-bottom: none; }
        .action-links a, .action-links button { text-decoration: none; padding: 5px 10px; border-radius: 6px; font-size: 0.85em; margin-right: 4px; border: none; cursor: pointer; font-family: var(--font-body); transition: opacity 0.2s; display: inline-flex; align-items: center; gap: 4px; }
        .action-links a:hover, .action-links button:hover { opacity: 0.8; }
        .btn-ubah { background-color: #FEF3C7; color: #92400E; }
        .btn-hapus { background-color: #FEE2E2; color: #991B1B; }
        .alert { padding: 1rem 1.2rem; border-radius: 8px; margin-bottom: 1.5rem; font-weight: 500; }
        .alert-success { background: #D1FAE5; color: #065F46; }
        .alert-danger { background: #FEE2E2; color: #991B1B; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 50px; font-size: 0.8em; font-weight: 600; }
        .badge-baru { background: #FEF3C7; color: #92400E; }
        .badge-proses { background: #DBEAFE; color: #1E40AF; }
        .badge-selesai { background: #D1FAE5; color: #065F46; }
        .badge-batal { background: #FEE2E2; color: #991B1B; }
    </style>
    @stack('styles')
</head>
<body>
<aside class="sidebar">
    <div class="logo">☕ HistoryKedai</div>
    <nav class="sidebar-nav">
        @php $jabatan = auth()->user()->jabatan; $current = request()->routeIs('dashboard.*') ? request()->route()->getName() : ''; @endphp

        <a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
            <span class="icon"><i class="fas fa-tachometer-alt"></i></span> Dasbor
        </a>

        @if(in_array($jabatan, ['Kasir', 'Admin', 'Pemilik']))
        <a href="{{ route('dashboard.pesanan') }}" class="{{ request()->routeIs('dashboard.pesanan*') ? 'active' : '' }}">
            <span class="icon"><i class="fas fa-inbox"></i></span> Pesanan Masuk
        </a>
        <a href="{{ route('dashboard.riwayat') }}" class="{{ request()->routeIs('dashboard.riwayat*') ? 'active' : '' }}">
            <span class="icon"><i class="fas fa-history"></i></span> Riwayat Transaksi
        </a>
        @endif

        @if(in_array($jabatan, ['Admin', 'Pemilik']))
        <a href="{{ route('dashboard.laporan') }}" class="{{ request()->routeIs('dashboard.laporan*') ? 'active' : '' }}">
            <span class="icon"><i class="fas fa-file-excel"></i></span> Laporan Penjualan
        </a>
        @endif

        @if($jabatan === 'Pemilik')
        <a href="{{ route('menu.index') }}" class="{{ request()->routeIs('menu.*') ? 'active' : '' }}">
            <span class="icon"><i class="fas fa-utensils"></i></span> Manajemen Menu
        </a>
        <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
            <span class="icon"><i class="fas fa-tags"></i></span> Manajemen Kategori
        </a>
        <a href="{{ route('karyawan.index') }}" class="{{ request()->routeIs('karyawan.*') ? 'active' : '' }}">
            <span class="icon"><i class="fas fa-users"></i></span> Manajemen Karyawan
        </a>
        @endif
    </nav>
    <div class="user-profile">
        <div class="avatar">{{ substr(auth()->user()->nama, 0, 1) }}</div>
        <div>
            <div class="name">{{ auth()->user()->nama }}</div>
            <div class="role">{{ auth()->user()->jabatan }}</div>
        </div>
        <form action="{{ route('logout') }}" method="POST" style="margin:0">
            @csrf
            <button type="submit" class="logout-btn" style="background:none;border:none;cursor:pointer;" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </div>
</aside>

<main class="main-content">
    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif
    @yield('content')
</main>

@stack('scripts')
</body>
</html>
