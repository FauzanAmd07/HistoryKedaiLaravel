<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'History Kedai - Kopi & Cerita')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* === DESIGN SYSTEM TOKENS (Sesuai README - Modul Pelanggan) === */
        :root {
            --color-primary: #6D28D9;
            --color-secondary: #8B5CF6;
            --color-light-bg: #F9FAFB;
            --color-surface: #FFFFFF;
            --color-dark-text: #111827;
            --color-muted-text: #6B7280;
            --color-white: #FFFFFF;
            --color-purple-deep: #6D28D9;
            --color-dark-purple: #5B21B6;
            --font-heading: 'Syne', sans-serif;
            --font-body: 'Poppins', sans-serif;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
            --shadow-subtle: 0 4px 12px rgba(0, 0, 0, 0.05);
            --border-radius: 12px;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); margin: 0; background: linear-gradient(135deg, #ffffff 0%, #c0aaff 100%); color: var(--color-dark-text); overflow-x: hidden; min-height: 100vh; }
    </style>
    @stack('styles')
</head>
<body>
    <div id="preloader" style="position:fixed;inset:0;background:var(--color-primary);z-index:10000;display:flex;align-items:center;justify-content:center;">
        <div style="width:50px;height:50px;border:5px solid rgba(255,255,255,0.3);border-top:5px solid white;border-radius:50%;animation:spin 1s linear infinite;"></div>
    </div>
    <style>@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}</style>

    @yield('content')

    <!-- Cart floating button -->
    <a href="{{ route('keranjang') }}" class="cart-link" style="position:fixed;bottom:30px;right:30px;z-index:1000;background:var(--color-primary);color:white;width:60px;height:60px;border-radius:50%;display:flex;align-items:center;justify-content:center;text-decoration:none;font-size:1.5rem;box-shadow:0 4px 12px rgba(0,0,0,0.3);transition:transform 0.3s;">
        <i class="fas fa-shopping-cart"></i>
        <span id="cart-count" style="position:absolute;top:-5px;right:-5px;background:var(--color-dark-purple);color:white;width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.8rem;font-weight:500;">0</span>
    </a>
    <div id="toast-container" style="position:fixed;bottom:30px;left:50%;transform:translateX(-50%);z-index:3000;"></div>

    <script>
        // Preloader
        gsap.to('#preloader', { opacity: 0, duration: 1, delay: 0.5, onComplete: () => document.getElementById('preloader').style.display = 'none' });
        // Update cart count from sessionStorage
        function updateCartCount() {
            const cart = JSON.parse(sessionStorage.getItem('cart')) || {};
            const count = Object.values(cart).reduce((s, i) => s + i.qty, 0);
            const el = document.getElementById('cart-count');
            if (el) el.innerText = count;
        }
        updateCartCount();
    </script>
    @stack('scripts')
</body>
</html>
