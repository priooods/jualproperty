<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>KAVLING</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
                  <a href="/">Bantarwangi Hills Residence</a>
                </div>
                <nav class="hidden md:flex space-x-6">
                <a href="/kavling" class="text-gray-700 hover:text-blue-600">Kavling</a>
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
            <a href="/kavling" class="text-gray-700 hover:text-blue-600">Kavling</a>
            <a href="/informasi" class="text-gray-700 hover:text-blue-600">Informasi</a>
            <a href="/tentang" class="text-gray-700 hover:text-blue-600">Tentang Kami</a>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-8 pt-20 pb-32 min-h-screen">
        @yield('main')
    </div>

  

  <!-- Optional Footer -->
  <footer class="bg-blue-700 text-white py-8">
    <div class="max-w-6xl mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-6">

        <!-- Nama Aplikasi -->
        <div class="">
          <h2 class="text-xl font-bold mb-2">Bantarwangi Hills Residence</h2>
          <p class="text-sm">Des, Kp Dahu, RT.01/RW.01, Bantarwangi, Kec. Cinangka, Kabupaten Serang, Banten 42167</p>
        </div>
        <!-- Menu Navigasi -->
        <div class="flex justify-end col-span-2 gap-x-8">
          <div class="flex my-auto gap-x-3">
            <a href="https://www.instagram.com/bantarwangiresidence?igsh=eHYycGRtaGU3ejVq" target="_blank" >
              <img src="https://img.icons8.com/fluency/48/instagram-new.png" alt="instagram-new" class="w-8 h-8"/>
            </a>
            <a href="https://maps.app.goo.gl/SYhScisQZCkKoM33A" target="_blank" >
              <img src="https://img.icons8.com/color/48/google-maps-new.png" alt="google-maps-new" class="w-8 h-8"/>
            </a>
          </div>
          <ul class="text-sm flex justify-start gap-x-4 my-auto">
            <li><a href="/kavling" class="hover:underline">Kavling</a></li>
            <li><a href="/informasi" class="hover:underline">Informasi</a></li>
            <li><a href="/tentang" class="hover:underline">Tentang Kami</a></li>
          </ul>
        </div>

      </div>

      <hr class="border-white/30 mb-4">

      <!-- Tulisan Formal Footer -->
      <div class="text-center text-xs text-white/80">
        &copy; 2025 Bantarwangi Hills Residence. Seluruh hak cipta dilindungi undang-undang.
      </div>
    </div>
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
