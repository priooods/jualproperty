@extends('master')
@section('main')
    <section>
        <section class="w-7/12">
            <p class="font-bold text-xl text-red-800 uppercase">{{ $data->title }} - {{$data->status_kavling->title}}</p>
            <p class="text-sm">{{$data->address}}</p>
            <p class="px-3 py-1.5 bg-red-800 text-white mt-4 text-xs font-normal text-center uppercase rounded-md w-fit">{{ $data->type->title }}</p>
            <div id="slider" class="slider-container w-full h-[450px] rounded-md shadow overflow-hidden mt-10">
                <div id="slider-track" class="slider-track w-full h-full">
                    @foreach ($data->images as $g)
                        <div class="slider-item w-full h-full">
                        <img src="{{ asset('storage/' . $g->path) }}" class="w-full h-full object-cover" alt="Slider Gambar">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-14">
                <p class="text-black font-semibold text-md mb-2 uppercase">Deskripsi :</p>
                <ol class=" list-inside list-disc">
                    @foreach ($data->description as $item)
                        <li class="text-sm">{{$item->description}}</li>
                    @endforeach
                </ol>
            </div>
            <div class="mt-14">
                <p class="text-black font-semibold text-md mb-2 uppercase">Fasilitas :</p>
                <ol class=" list-inside list-disc">
                    @foreach ($data->facility as $item)
                        <li class="text-sm">{{$item->description}}</li>
                    @endforeach
                </ol>
            </div>
            <div class="grid grid-cols-2 gap-10 mt-12">
                <div class="block">
                    <p class="text-black font-semibold text-md mb-2 uppercase">Harga :</p>
                    <p class="text-red-900 text-xl font-bold">
                        Rp. {{number_format($data->price, 0, ',', '.')}},-
                    </p>
                </div>
                <div class="block">
                    <p class="text-black font-semibold text-md mb-2 uppercase">Luas :</p>
                    <p class="text-xl text-red-900">{{$data->size}}.00 m&sup2;</p>
                </div>
            </div>
            @if ($data->m_status_tabs_transaction_id == 5)
                <div class="grid grid-cols-2 gap-10 mt-12">
                    <a href="{{$data->id}}/edit" class="bg-green-700 text-white text-md uppercase text-center py-2 font-semibold">Pesan Sekarang</a>
                    <a  href="https://wa.me/6281234567890?text=Halo%2C%20saya%20tertarik%20dengan%20produk%20Anda" target="_blank" class="bg-green-700 text-white text-md uppercase text-center py-2  font-semibold">Tanya Via WhatsApp</a>
                </div>
            @endif
        </section>
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