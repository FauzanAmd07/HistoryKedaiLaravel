@extends('layouts.app')
@section('title', 'History Kedai - Kopi & Cerita')

@push('styles')
<style>
.container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
.section { padding: 100px 0; }
.section-title { font-family: var(--font-heading); font-size: 3rem; font-weight: 800; text-align: center; margin-bottom: 50px; color: var(--color-dark-text); }
.section-title span { color: var(--color-primary); }
.cta-button { display: inline-block; padding: 1rem 2.5rem; background: var(--color-primary); color: white; text-decoration: none; font-weight: 600; border-radius: 50px; transition: all 0.3s ease; border: none; cursor: pointer; font-family: var(--font-body); font-size: 1rem; }
.cta-button:hover { transform: translateY(-3px); box-shadow: 0 5px 20px rgba(109,40,217,0.3); color: white; }
.header { position: fixed; width: 100%; top: 0; left: 0; z-index: 1000; display: flex; justify-content: space-between; align-items: center; padding: 1.5rem 4rem; background-color: transparent; transition: all 0.4s ease; }
.header.scrolled { background-color: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 1rem 4rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
.logo { font-family: var(--font-body); font-weight: 700; font-size: 1.5rem; text-decoration: none; color: var(--color-primary); display: flex; align-items: center; gap: 10px; }
.header-nav { display: flex; align-items: center; gap: 2rem; }
.nav-links { display: flex; gap: 2rem; }
.nav-links a { text-decoration: none; color: var(--color-dark-text); font-weight: 500; position: relative; }
.nav-links a::after { content:''; position:absolute; width:0; height:2px; background:var(--color-primary); bottom:-5px; left:50%; transform:translateX(-50%); transition:width 0.3s; }
.nav-links a:hover::after { width: 100%; }
.nav-login a { text-decoration: none; color: var(--color-primary); font-weight: 500; border: 1px solid var(--color-primary); padding: 0.6rem 1.2rem; border-radius: 50px; transition: all 0.3s ease; white-space: nowrap; }
.nav-login a:hover { background: var(--color-primary); color: white; }
.hero { padding-top: 150px; min-height: 90vh; display: flex; align-items: center; }
.hero-content { display: grid; grid-template-columns: 1fr 1.2fr; align-items: center; gap: 4rem; }
.hero-text h1 { font-family: var(--font-heading); font-size: clamp(3rem,7vw,5rem); line-height: 1.1; font-weight: 800; margin: 0 0 1.5rem; }
.hero-text p { font-size: 1.1rem; margin-bottom: 2.5rem; color: var(--color-muted-text); line-height: 1.7; }
.hero-image img { width: 100%; border-radius: var(--border-radius); box-shadow: var(--shadow); }
.menu-controls { display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 50px; flex-wrap: wrap; }
.filter-btn, #search-menu { background: white; border: 1px solid #E5E7EB; padding: 10px 22px; border-radius: 50px; cursor: pointer; font-weight: 500; transition: all 0.3s ease; font-family: var(--font-body); font-size: 0.95rem; }
.filter-btn.active, .filter-btn:hover { background: var(--color-primary); color: white; border-color: var(--color-primary); }
#search-menu { width: 220px; }
.menu-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 28px; }
.menu-card { background: white; border-radius: var(--border-radius); box-shadow: var(--shadow-subtle); cursor: pointer; transition: transform 0.3s, box-shadow 0.3s; display: none; border: 1px solid #E5E7EB; overflow: hidden; }
.menu-card:hover { transform: translateY(-8px); box-shadow: var(--shadow); }
.menu-card img { width: 100%; height: 200px; object-fit: cover; }
.menu-card-content { padding: 20px; text-align: center; }
.menu-card h3 { font-family: var(--font-heading); font-size: 1.3rem; margin: 0 0 8px; }
.menu-card .harga { font-size: 1.2rem; color: var(--color-primary); font-weight: bold; }
.bestseller-container { display: flex; gap: 25px; padding: 15px 0; overflow-x: auto; scrollbar-width: none; }
.bestseller-container::-webkit-scrollbar { display: none; }
.bestseller-card { flex: 0 0 280px; background: white; border-radius: var(--border-radius); box-shadow: var(--shadow); text-align: center; padding: 1.5rem; transition: transform 0.3s; }
.bestseller-card:hover { transform: translateY(-5px); }
.bestseller-card img { width: 110px; height: 110px; border-radius: 50%; object-fit: cover; margin-bottom: 1rem; border: 4px solid #F3F4F6; }
.bestseller-card h3 { font-family: var(--font-heading); font-size: 1.2rem; margin: 0.5rem 0; }
.modal { position: fixed; z-index: 2000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: all 0.3s; }
.modal.active { opacity: 1; visibility: visible; }
.modal-content { background: white; color: var(--color-dark-text); padding: 40px; border-radius: var(--border-radius); width: 90%; max-width: 780px; display: flex; gap: 30px; position: relative; transform: scale(0.9); transition: transform 0.3s; }
.modal.active .modal-content { transform: scale(1); }
.modal-img { width: 50%; } .modal-img img { width: 100%; border-radius: var(--border-radius); }
.modal-details { width: 50%; } .modal-details h2 { font-family: var(--font-heading); font-size: 2rem; margin-top: 0; color: var(--color-primary); }
.modal-details .harga { font-size: 1.8rem; color: var(--color-primary); margin: 15px 0; font-weight: bold; }
.close-modal { position: absolute; top: 15px; right: 20px; font-size: 2rem; color: #ccc; cursor: pointer; transition: color 0.3s; background: none; border: none; }
.close-modal:hover { color: var(--color-dark-text); }
.toast { background: var(--color-purple-deep); color: white; font-weight: 500; padding: 13px 22px; border-radius: 50px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); opacity: 0; transform: translateY(20px); transition: all 0.5s cubic-bezier(0.25,0.8,0.25,1); margin-top: 8px; }
.toast.show { opacity: 1; transform: translateY(0); }
@keyframes cartBounce { 0%,100%{transform:scale(1)} 30%{transform:scale(1.5)} 60%{transform:scale(0.9)} }
.cart-badge-bounce { animation: cartBounce 0.5s cubic-bezier(0.36,0.07,0.19,0.97) both; }
#menu { background: var(--color-surface); }
.parallax-section { padding: 150px 0; background-image: url('/images/foodcourt.jpg'); background-attachment: fixed; background-position: center; background-size: cover; position: relative; color: white; text-align: center; }
.parallax-section::before { content:''; position:absolute; inset:0; background:rgba(0,0,0,0.6); }
.parallax-content { position: relative; z-index: 2; }
.parallax-content h2 { font-family: var(--font-heading); font-size: 3rem; margin-bottom: 2rem; }
.footer { background: var(--color-dark-text); color: var(--color-light-bg); padding: 80px 4rem 30px; }
.footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 40px; }
.footer-links h4 { color: var(--color-primary); font-family: var(--font-heading); }
.footer-links a { text-decoration: none; color: var(--color-muted-text); transition: color 0.3s; display: block; margin-bottom: 8px; }
.footer-links a:hover { color: white; }
.footer-socials a { color: var(--color-muted-text); margin-right: 15px; font-size: 1.5rem; transition: color 0.3s; }
.footer-socials a:hover { color: white; }
.footer-bottom { text-align: center; padding-top: 30px; border-top: 1px solid #374151; color: var(--color-muted-text); }
</style>
@endpush

@section('content')
<header class="header" id="header">
    <a href="{{ route('home') }}" class="logo">☕ HistoryKedai</a>
    <div class="header-nav">
        <nav class="nav-links">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="#menu">Menu</a>
            <a href="#lokasi">Lokasi</a>
        </nav>
        <div class="nav-login"><a href="{{ route('login') }}">Login Karyawan</a></div>
    </div>
</header>

<section class="hero">
    <div class="container hero-content">
        <div class="hero-text">
            <h1>Setiap Tegukan, Punya Cerita.</h1>
            <p>Kami percaya setiap minuman adalah sebuah pengalaman. Temukan pengalaman rasa favoritmu di sini, disajikan segar hanya untukmu.</p>
            <a href="#menu" class="cta-button">Jelajahi Menu</a>
        </div>
        <div class="hero-image">
            <img src="{{ asset('images/minuman.png') }}" alt="Minuman History Kedai">
        </div>
    </div>
</section>

{{-- Best Seller --}}
<section class="section" id="bestseller" style="background:white;">
    <div class="container">
        <h2 class="section-title">Menu <span>Andalan</span> Kami</h2>
        <div class="bestseller-container">
        @foreach($bestsellers as $item)
            <div class="bestseller-card">
                @if($item->gambar)
                <img src="{{ asset('storage/gambar/'.$item->gambar) }}" alt="{{ $item->nama_menu }}">
                @else
                <div style="width:110px;height:110px;border-radius:50%;background:#F3E8FF;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:2rem;">☕</div>
                @endif
                <h3>{{ $item->nama_menu }}</h3>
                <div style="color:var(--color-primary);font-weight:bold;">Rp {{ number_format($item->harga,0,',','.') }}</div>
            </div>
        @endforeach
        </div>
    </div>
</section>

{{-- Menu --}}
<section class="section" id="menu">
    <div class="container">
        <h2 class="section-title"><span>Daftar</span> Menu</h2>
        <div class="menu-controls">
            <button class="filter-btn active" data-filter="all">Semua Menu</button>
            @foreach($kategoris as $kategori)
            <button class="filter-btn" data-filter="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</button>
            @endforeach
            <input type="text" id="search-menu" placeholder="Cari menu...">
        </div>
        <div class="menu-grid">
            @foreach($menus as $menu)
            <div class="menu-card"
                 data-category="{{ $menu->kategori->nama_kategori }}"
                 data-name="{{ strtolower($menu->nama_menu) }}"
                 data-id="{{ $menu->id_menu }}"
                 data-nama-lengkap="{{ $menu->nama_menu }}"
                 data-harga="{{ $menu->harga }}"
                 data-deskripsi="{{ $menu->deskripsi }}"
                 data-gambar="{{ $menu->gambar ? asset('storage/gambar/'.$menu->gambar) : '' }}"
                 onclick="openModal(this)">
                @if($menu->gambar)
                <img src="{{ asset('storage/gambar/'.$menu->gambar) }}" alt="{{ $menu->nama_menu }}">
                @else
                <div style="width:100%;height:200px;background:linear-gradient(135deg,#F3E8FF,#EDE9FE);display:flex;align-items:center;justify-content:center;font-size:3rem;">☕</div>
                @endif
                <div class="menu-card-content">
                    <h3>{{ $menu->nama_menu }}</h3>
                    <div class="harga">Rp {{ number_format($menu->harga,0,',','.') }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="parallax-section">
    <div class="parallax-content"><h2>Rasa yang Bercerita.</h2></div>
</section>

<section class="section" id="lokasi" style="background:white;">
    <div class="container">
        <h2 class="section-title"><span>Temukan</span> Kami</h2>
        <div style="display:grid;grid-template-columns:1fr 1.5fr;align-items:center;gap:50px;">
            <div>
                <h3 style="font-family:var(--font-heading);font-size:2rem;">Kunjungi Kedai Kami</h3>
                <p style="color:var(--color-muted-text);line-height:1.8;">Kami menanti Anda untuk berbagi cerita sambil menikmati minuman segar. Temukan kami di Food Court Universitas Negeri Makassar.</p>
                <p><strong>Alamat:</strong><br>Jl. Raya Pendidikan No. 22, Tidung, Kec. Rappocini<br>Makassar, Sulawesi Selatan, 90221</p>
                <p><strong>Jam Buka:</strong><br>Senin - Sabtu: 07:00 - 17:00 WITA</p>
            </div>
            <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31788.75096329477!2d119.39795497431642!3d-5.168843000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee291f084750b%3A0xa4f4abfdff834d4b!2sUniversitas%20Negeri%20Makassar!5e0!3m2!1sid!2sid!4v1759409672141!5m2!1sid!2sid" width="100%" height="400" style="border:0;border-radius:12px;" allowfullscreen loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div><h3 style="color:var(--color-primary);font-family:var(--font-heading);">☕ HistoryKedai</h3><p style="color:var(--color-muted-text);">Menyajikan cerita terbaik dalam setiap tegukan.</p></div>
            <div class="footer-links"><h4>Tautan Cepat</h4><a href="{{ route('home') }}">Beranda</a><a href="#menu">Menu</a><a href="#lokasi">Lokasi</a></div>
            <div class="footer-links"><h4>Kontak</h4><p style="color:var(--color-muted-text);">kontak@historykedai.com</p></div>
            <div class="footer-links"><h4>Sosial Media</h4><div class="footer-socials"><a href="https://www.instagram.com/kedaihistory_"><i class="fab fa-instagram"></i></a><a href="#"><i class="fab fa-facebook-f"></i></a></div></div>
        </div>
        <div class="footer-bottom">&copy; {{ date('Y') }} HistoryKedai.</div>
    </div>
</footer>

{{-- Modal --}}
<div class="modal" id="menu-modal">
    <div class="modal-content">
        <button class="close-modal" onclick="closeModal()">×</button>
        <div class="modal-img"><img id="modal-img" src="" alt="Detail Menu"></div>
        <div class="modal-details">
            <h2 id="modal-name"></h2>
            <p id="modal-desc" style="color:var(--color-muted-text);line-height:1.7;"></p>
            <div class="harga" id="modal-price"></div>
            <button id="modal-add-to-cart" class="cta-button" style="width:100%">Tambah ke Keranjang</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
gsap.registerPlugin(ScrollTrigger);

// Animasi Hero
gsap.from('.hero-text > *', { opacity: 0, y: 30, stagger: 0.3, duration: 1, delay: 0.8 });
gsap.from('.hero-image', { opacity: 0, scale: 0.9, duration: 1, delay: 0.5 });

// Scroll-trigger animations
document.querySelectorAll('.section').forEach(section => {
    const elems = section.querySelectorAll('.section-title, .bestseller-card, .menu-controls, .menu-card');
    if (elems.length > 0) {
        gsap.from(elems, { opacity: 0, y: 50, duration: 0.8, stagger: 0.1, scrollTrigger: { trigger: section, start: 'top 80%', toggleActions: 'play none none none' } });
    }
});

// Header scroll effect
const header = document.getElementById('header');
window.addEventListener('scroll', () => { header.classList.toggle('scrolled', window.scrollY > 50); });

// === FILTER KATEGORI DENGAN GSAP STAGGER (Sesuai README) ===
function filterKategori(kategoriId, searchTerm = '') {
    gsap.to('.menu-card', { opacity: 0, y: 20, duration: 0.2, onComplete: () => {
        document.querySelectorAll('.menu-card').forEach(card => {
            const catMatch = kategoriId === 'all' || (card.dataset.category || '').toLowerCase() === kategoriId.toLowerCase();
            const searchMatch = searchTerm === '' || (card.dataset.name || '').includes(searchTerm.toLowerCase());
            card.style.display = (catMatch && searchMatch) ? 'block' : 'none';
        });
        const visibleCards = document.querySelectorAll('.menu-card[style*="display: block"]');
        if (visibleCards.length > 0) {
            gsap.to(visibleCards, { opacity: 1, y: 0, duration: 0.4, stagger: 0.05 });
        }
    }});
}

// Tombol filter
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('.filter-btn.active').classList.remove('active');
        btn.classList.add('active');
        filterKategori(btn.dataset.filter, document.getElementById('search-menu').value);
    });
});

// Search input realtime
document.getElementById('search-menu').addEventListener('input', function() {
    const activeFilter = document.querySelector('.filter-btn.active').dataset.filter;
    filterKategori(activeFilter, this.value);
});

// Inisialisasi - tampilkan semua menu
filterKategori('all');

// Cart & Modal
const cart = JSON.parse(sessionStorage.getItem('cart')) || {};

const updateCartCount = () => {
    const count = Object.values(cart).reduce((s, i) => s + i.qty, 0);
    const el = document.getElementById('cart-count');
    if (el) el.innerText = count;
};

const showToast = (msg) => {
    const c = document.getElementById('toast-container');
    const t = document.createElement('div'); t.className = 'toast show'; t.innerText = msg;
    c.appendChild(t);
    setTimeout(() => { t.classList.remove('show'); setTimeout(() => c.removeChild(t), 500); }, 3000);
};

const addToCart = (id, name, price) => {
    id = parseInt(id); price = parseFloat(price);
    if (cart[id]) cart[id].qty++; else cart[id] = { name, price, qty: 1 };
    sessionStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    // Bounce effect sesuai README
    const cartBadge = document.getElementById('cart-count');
    if (cartBadge) { cartBadge.classList.remove('cart-badge-bounce'); void cartBadge.offsetWidth; cartBadge.classList.add('cart-badge-bounce'); }
    showToast(`"${name}" ditambahkan!`);
};

const modal = document.getElementById('menu-modal');
let addBtn = document.getElementById('modal-add-to-cart');

window.openModal = (el) => {
    const d = el.dataset;
    document.getElementById('modal-img').src = d.gambar || '';
    document.getElementById('modal-name').innerText = d.namaLengkap;
    document.getElementById('modal-desc').innerText = d.deskripsi || '';
    document.getElementById('modal-price').innerText = `Rp ${parseInt(d.harga).toLocaleString('id-ID')}`;
    const nb = addBtn.cloneNode(true);
    addBtn.parentNode.replaceChild(nb, addBtn); addBtn = nb;
    addBtn.onclick = () => { addToCart(d.id, d.namaLengkap, d.harga); closeModal(); };
    modal.classList.add('active');
};

window.closeModal = () => modal.classList.remove('active');
modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
updateCartCount();
</script>
@endpush
