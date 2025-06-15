@extends('master')
@section('main')
    <section>
        <div class="w-full">
            <h1 class="text-2xl font-bold text-gray-900 leading-tight mb-6">
                Selamat Datang di Penjualan Property
            </h1>
            <p class="text-sm text-gray-600 mb-8">
                Penjualan Property adalah sebuah website yang memberikan kemudahan bagi Anda yang ingin melakukan investasi di bidang tanah. Karena kami menyediakan berbagai lahan tanah kavling di berbagai daerah, yang dapat anda miliki dengan cara cukup mencicil dengan nominal yang sudah ditentukan
            </p>
        </div>
    </section>
    <section class="mt-16">
        <div class="text-center w-full mb-10">
            <p class="font-bold text-lg text-red-800">KAVLING TERBARU</p>
            <p class="text-xs">Ini adalah daftar seluruh kavling terbaru dari berbagai kategori, jenis, dan wilayah.</p>
        </div>
        @isset($data)
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
        @endisset
    </section>
    <script>
        const track = document.getElementById('slider-track');
        const slides = document.querySelectorAll('.slider-item');
        let index = 0;
    
        function autoSlide() {
          index = (index + 1) % slides.length;
          track.style.transform = `translateX(-${index * 100}%)`;
        }
    
        setInterval(autoSlide, 3000); // Ganti slide tiap 3 detik
      </script>
@endsection