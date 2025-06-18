@extends('master')
@section('main')
    <section>
        @isset($data)
            @if (count($data) > 0)
                <div class="grid grid-cols-10 gap-1">
                        @foreach ($data as $item)
                            @if ($item->status_kavling->id == 5)
                                <a class="bg-green-700 text-white font-semibold px-4 py-2 text-center" href="kavling/{{$item->id}}">
                                    <p class="text-md">{{ $item->title }}</p>
                                    <span class="mt-5 text-[9px] font-normal">{{ $item->status_kavling->title }}</span>
                                </a>
                            @else
                                <div class="bg-gray-400 text-white font-semibold px-4 py-2 text-center">
                                    <p class="text-md">{{ $item->title }}</p>
                                    <span class="mt-5 text-[9px] font-normal">{{ $item->status_kavling->title }}</span>
                                </div>
                            @endif
                        @endforeach
                </div>
            @else
                <p class="text-center text-sm">-- Tidak Ada informasi Kavling Tersedia Yang Dapat Dipesan --</p>
            @endif
        @endisset
    </section>
@endsection