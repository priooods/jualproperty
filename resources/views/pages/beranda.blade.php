@extends('master')
@section('main')
    <section>
        <div class="w-full">
            <div id="slider" class="slider-container w-full h-[380px] overflow-hidden">
                <div id="slider-track" class="slider-track w-full h-full">
                    @foreach ($imageList as $g)
                        <div class="slider-item w-full h-full relative">
                            <img src="{{ asset('storage/' . $g['path']) }}" class="w-full h-full object-cover" alt="Slider Gambar">
                            <p class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white font-bold text-3xl uppercase">{{$g['title']}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="flex md:flex-row flex-col gap-x-9 gap-y-4 mt-32">
                <div>
                    <h1 class="text-5xl text-gray-900 leading-tight mt-20 uppercase font-bold" style="font-family: 'Inter', sans-serif;">
                        Cari, Pilih, Miliki Kavling Tanah Lebih Mudah
                    </h1>
                    <div class="flex justify-start gap-x-5 mt-10">
                        <a href="https://www.instagram.com/bantarwangiresidence?igsh=eHYycGRtaGU3ejVq" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="inline-block bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 text-white px-6 py-2 rounded-full font-semibold shadow-md hover:brightness-110 transition duration-300">
                            Kunjungi Instagram Kami
                        </a>
                        <a href="https://maps.app.goo.gl/SYhScisQZCkKoM33A" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="inline-block bg-green-800 text-white px-6 py-2 rounded-full font-semibold shadow-md hover:brightness-110 transition duration-300">
                            Lihat di Maps
                        </a>
                    </div>
                </div>
                <img src="{{ asset('storage/images/get.png') }}" class="w-92 h-92 object-cover md:ml-auto" alt="img">
            </div>
            <div class="mt-36">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">

                    <!-- Kotak 1: Kavling Berkualitas -->
                    <div class="border border-gray-100 rounded-xl shadow-md p-6 hover:shadow-lg transition">
                        <div class="text-blue-600 text-5xl mb-4">
                            📍
                        </div>
                        <h3 class="text-xl font-bold mb-2">Kavling Berkualitas</h3>
                        <p class="text-gray-600 text-sm">
                            Lokasi strategis, legalitas jelas, dan siap bangun. Investasi aman untuk masa depan Anda!
                        </p>
                    </div>

                    <!-- Kotak 2: Pembayaran Fleksibel -->
                    <div class="border border-gray-100 rounded-xl shadow-md p-6 hover:shadow-lg transition">
                        <div class="text-blue-600 text-5xl mb-4">
                            💳
                        </div>
                        <h3 class="text-xl font-bold mb-2">Pembayaran Fleksibel</h3>
                        <p class="text-gray-600 text-sm">
                            Cicilan ringan, tanpa bunga, dan dapat disesuaikan dengan kemampuan Anda. Tanpa beban!
                        </p>
                    </div>

                    <!-- Kotak 3: Proses Digital -->
                    <div class="border border-gray-100 rounded-xl shadow-md p-6 hover:shadow-lg transition">
                        <div class="text-blue-600 text-5xl mb-4">
                            📲
                        </div>
                        <h3 class="text-xl font-bold mb-2">Proses Digital</h3>
                        <p class="text-gray-600 text-sm">
                            Dari pemesanan hingga pembayaran, semua bisa dilakukan secara online. Praktis dan efisien!
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="h-[1px] w-full my-20"></div>
    <section>
        <div class="w-full mb-14 p-4">
            <p class="text-gray-800 text-base font-medium mb-4 text-center">Temukan Kavling Idaman Anda Dengan Kami</p>
            <form action="{{ route('beranda') }}" method="GET" class="flex space-x-2">
                <input 
                    type="text" 
                    name="title" 
                    placeholder="Masukkan kata kunci..." 
                    class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Cari Kavling
                </button>
            </form>
        </div>
        <div class="text-center w-full mb-10">
            <p class="font-bold text-2xl text-red-800">KAVLING TERSEDIA</p>
            <p class="text-md">Ini adalah daftar seluruh kavling tersedia dari berbagai kategori, jenis, dan wilayah.</p>
        </div>
        @if(isset($data) && count($data) > 0)
            <div class="grid grid-cols-4 gap-4">
                @foreach ($data as $item)
                    <a class="rounded-lg border border-gray-300 shadow-xl cursor-pointer" href="kavling/{{$item->id}}">
                        <div id="slider" class="slider-container w-full h-64 rounded-lg shadow overflow-hidden">
                            <div id="slider-track" class="slider-track w-full h-full">
                              @foreach ($item->images as $g)
                                <div class="slider-item w-full h-full">
                                  <img src="{{ asset('storage/' . $g->path) }}" class="w-full h-full object-cover" alt="Slider Gambar">
                                </div>
                              @endforeach
                            </div>
                          </div>
                        <div class="mt-1 px-5 py-3">
                            <p class="text-red-900 font-bold uppercase text-lg">{{ $item->title }}</p>
                            <span class="text-sm">{{ $item->address }}</span>
                            <p class="mt-3 text-red-900 text-xl font-bold">
                                Rp. {{number_format($item->price, 0, ',', '.')}}
                            </p>
                            <p class="text-md mt-1">{{$item->size}} m&sup2;</p>
                            <div class="grid grid-cols-2 gap-3 mt-5">
                                <p class="px-3 py-1.5 border border-red-700 text-red-700 text-xs font-normal text-center uppercase rounded-md">{{ $item->type->title }}</p>
                                <p class="px-3 py-1.5 bg-green-900 text-white text-xs font-normal text-center uppercase rounded-md">{{ $item->status_kavling->title }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-center text-sm">-- Tidak Ada Kavling Tersedia Yang Dapat Dipesan --</p>
        @endif
    </section>
    <div class="h-[1px] bg-gray-200 w-full my-16"></div>
    <section>
        <div class="text-center w-full mb-10">
            <p class="font-bold text-2xl text-red-800">SEMUA KAVLING</p>
            <p class="text-md">Ini adalah daftar seluruh kavling dari berbagai kategori, jenis, dan wilayah.</p>
        </div>
        @isset($data)
            <div class="grid grid-cols-4 gap-4">
                @foreach ($list as $item)
                    <a class="rounded-lg border border-gray-300 shadow-xl cursor-pointer" href="kavling/{{$item->id}}">
                        <div id="slider" class="slider-container w-full h-64 rounded-lg shadow overflow-hidden">
                            <div id="slider-track" class="slider-track w-full h-full">
                              @foreach ($item->images as $g)
                                <div class="slider-item w-full h-full">
                                  <img src="{{ asset('storage/' . $g->path) }}" class="w-full h-full object-cover" alt="Slider Gambar">
                                </div>
                              @endforeach
                            </div>
                          </div>
                        <div class="mt-1 px-5 py-3">
                            <p class="text-red-900 font-bold uppercase text-lg">{{ $item->title }}</p>
                            <span class="text-sm">{{ $item->address }}</span>
                            <p class="mt-3 text-red-900 text-xl font-bold">
                                Rp. {{number_format($item->price, 0, ',', '.')}}
                            </p>
                            <p class="text-md mt-1">{{$item->size}} m&sup2;</p>
                            <div class="grid grid-cols-2 gap-3 mt-5">
                                <p class="px-3 py-1.5 border border-red-700 text-red-700 text-xs font-normal text-center uppercase rounded-md">{{ $item->type->title }}</p>
                                <p class="px-3 py-1.5 bg-red-900 text-white text-xs font-normal text-center uppercase rounded-md">{{ $item->status_kavling->title }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endisset
    </section>
    {{-- <section class="mt-32">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-8">Kata Mereka</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">

            <!-- Testimoni 1 -->
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
                <p class="text-gray-600 italic mb-4">
                "Saya sempat ragu beli kavling online, tapi ternyata prosesnya cepat, lokasi sesuai, dan legalitasnya aman. Terima kasih tim Solusi Digital!"
                </p>
                <div class="font-semibold text-gray-800">Andi Prasetyo</div>
                <div class="text-sm text-gray-500">Jakarta Selatan</div>
            </div>

            <!-- Testimoni 2 -->
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
                <p class="text-gray-600 italic mb-4">
                "Pembayaran bisa dicicil tanpa ribet, cocok banget buat saya yang baru mulai investasi properti. Highly recommended!"
                </p>
                <div class="font-semibold text-gray-800">Rina Widjaja</div>
                <div class="text-sm text-gray-500">Depok</div>
            </div>

            <!-- Testimoni 3 -->
            <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
                <p class="text-gray-600 italic mb-4">
                "Semua bisa diurus lewat HP aja. Nggak perlu ke kantor, tapi tetap jelas dan profesional. Sangat membantu!"
                </p>
                <div class="font-semibold text-gray-800">Yoga Mahendra</div>
                <div class="text-sm text-gray-500">Bandung</div>
            </div>

            </div>
        </div>
    </section> --}}

    <script>
        const track = document.getElementById('slider-track');
        let slides = document.querySelectorAll('.slider-item');
        let index = 1;

        // Clone first and last slides
        const firstClone = slides[0].cloneNode(true);
        const lastClone = slides[slides.length - 1].cloneNode(true);

        // Tambahkan clone ke DOM
        track.appendChild(firstClone);
        track.insertBefore(lastClone, slides[0]);

        // Update slide list
        slides = document.querySelectorAll('.slider-item');

        // Set posisi awal ke slide 1 (bukan clone)
        track.style.transform = `translateX(-${index * 100}%)`;

        // Fungsi untuk geser slide
        function autoSlide() {
        index++;
        track.style.transition = 'transform 0.5s ease-in-out';
        track.style.transform = `translateX(-${index * 100}%)`;

        // Saat mencapai clone terakhir (di paling kanan)
        track.addEventListener('transitionend', () => {
            if (slides[index].isEqualNode(firstClone)) {
            track.style.transition = 'none';
            index = 1;
            track.style.transform = `translateX(-${index * 100}%)`;
            }

            // Saat kembali ke clone pertama (di paling kiri)
            if (slides[index].isEqualNode(lastClone)) {
            track.style.transition = 'none';
            index = slides.length - 2;
            track.style.transform = `translateX(-${index * 100}%)`;
            }
        }, { once: true });
        }

        // Jalankan otomatis setiap 3 detik
        setInterval(autoSlide, 3000); // Ganti slide tiap 3 detik
      </script>
@endsection