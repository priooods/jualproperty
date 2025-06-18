<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KAVLING</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .slider-container {
      overflow: hidden;
      position: relative;
    }
    .slider-track {
      display: flex;
      transition: transform 0.5s ease-in-out;
    }
    .slider-item {
      flex: 0 0 100%;
    }
  </style>
</head>
<body class="bg-white text-gray-800">

  <!-- Navigation -->
    <header class="bg-white shadow-md fixed w-full top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="text-2xl font-bold text-blue-600">
                  <a href="/">Penjualan Property</a>
                </div>
                <nav class="hidden md:flex space-x-6">
                <a href="/" class="text-gray-700 hover:text-blue-600">Kavling</a>
                <a href="/informasi" class="text-gray-700 hover:text-blue-600">Informasi</a>
                <a href="/tentang" class="text-gray-700 hover:text-blue-600">Tentang Kami</a>
                </nav>
                <div class="md:hidden">
                <button id="menu-btn" class="focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden px-4 pb-4 space-y-2">
            <a href="/" class="text-gray-700 hover:text-blue-600">Kavling</a>
            <a href="/informasi" class="text-gray-700 hover:text-blue-600">Informasi</a>
            <a href="/informasi" class="text-gray-700 hover:text-blue-600">Tentang Kami</a>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-8 py-32 min-h-screen">
        @yield('main')
    </div>

  

  <!-- Optional Footer -->
  <footer class="bg-white border-t py-6 text-center text-gray-500 text-sm">
    © 2025 Penjualan Property. Semua Hak Dilindungi.
  </footer>

  <script>
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');

    btn.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
