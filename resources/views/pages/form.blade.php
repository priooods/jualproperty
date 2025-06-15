@extends('master')
@section('main')
    <section>
        <div class="bg-white max-w-4xl mx-auto p-6 border border-gray-200 rounded-lg">
            <h2 class="text-2xl font-bold mb-4 text-center pb-4 border-b uppercase">Formulir pemesanan Kavling</h2>
            <p class="font-bold text-md uppercase pb-3 border-b border-gray-300">Informasi Detail kavling pesanan anda</p>
            <form action="{{ route('kavling.payment', $data->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
        
                <!-- Data Kavling (readonly) -->
                <div>
                    <div class="grid grid-cols-2 pb-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Nama kavling</p>
                        <p class="text-green-700 text-sm">{{$data->title}}</p>
                    </div>
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Harga kavling</p>
                        <p class="text-green-700 text-sm">Rp. {{number_format($data->price, 0, ',', '.')}},-</p>
                    </div>
                    
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Luas kavling</p>
                        <p class="text-green-700 text-sm">{{$data->size}}.00 m&sup2;</p>
                    </div>
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Lokasi kavling</p>
                        <p class="text-green-700 text-sm">{{$data->address}}</p>
                    </div>
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Kategori kavling</p>
                        <p class="text-green-700 text-sm">{{$data->type->title}}</p>
                    </div>
                </div>
        
                <!-- Informasi Pembeli -->
                <div>
                    <p class="font-bold text-md uppercase pb-3 border-b border-gray-300">lengkapi kolom biodata data</p>
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Nama Lengkap <span class="text-red-500">*</span></p>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Nama Lengkap" class="text-sm bg-gray-100 w-full border rounded-md p-2">
                    </div>
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Nomor KTP <span class="text-red-500">*</span></p>
                        <input type="number" name="nomor_ktp" value="{{ old('nomor_ktp') }}" placeholder="Nomor KTP" class="text-sm bg-gray-100 w-full border rounded-md p-2">
                    </div>
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Nomor KK <span class="text-red-500">*</span></p>
                        <input type="number" name="nomor_kk" value="{{ old('nomor_kk') }}" placeholder="Nomor KK" class="text-sm bg-gray-100 w-full border rounded-md p-2">
                    </div>
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Nomor Handphone <span class="text-red-500">*</span></p>
                        <input type="number" name="nomor_hp" value="{{ old('nomor_hp') }}" placeholder="Nomor Handphone" class="text-sm bg-gray-100 w-full border rounded-md p-2">
                    </div>
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Alamat Email <span class="text-red-500">*</span></p>
                        <div class="w-full">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="text-sm bg-gray-100 w-full border rounded-md p-2">
                            <p class="text-xs leading-tight italic mt-1 text-gray-600"> <span class="text-red-600">*</span>Kami akan mengirimkan informasi invoice anda melalui email yang anda masukan. Pastikan alamat email anda aktif</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Catatan</p>
                        <textarea name="catatan" rows="2" value="{{ old('catatan') }}" placeholder="Catatan" class="text-sm bg-gray-100 w-full border rounded-md p-2"></textarea>
                    </div>
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Nama Agent</p>
                        <select name="agent_id" class="w-full border rounded-md p-2 bg-gray-100">
                            <option value="" disabled selected {{ old('agent_id') ? '' : 'selected' }}>Pilih Agent</option>
                            @foreach($agent as $agen)
                                <option value="{{ $agen->id }}" {{ old('agent_id') == $agen->id ? 'selected' : '' }}>{{ $agen->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Upload KTP <span class="text-red-500">*</span></p>
                        <input type="file" name="upload_ktp" accept="image/*" placeholder="Upload KTP" class="text-sm bg-gray-100 w-full border rounded-md p-2">
                    </div>
                    <div class="grid grid-cols-2 py-3 border-b border-gray-300">
                        <p class="my-auto text-sm">Jumlah DP</p>
                        <input type="number" name="down_payment" value="{{$data->down_payment}}" class="text-sm bg-gray-100 w-full border hidden rounded-md p-2">
                        <p class="text-red-700 text-sm font-bold">Rp. {{number_format($data->down_payment, 0, ',', '.')}},-</p>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <strong>Oops!</strong> Ada yang salah:<br>
                        <ul class="list-disc pl-5 mt-2 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Tombol Simpan -->
                <div class="pt-4">
                    <p class="text-sm ">Dengan menekan tombol <b>Kirim Pesanan</b> di bawah ini, saya menyatakan telah menyetujui <b>Syarat dan Ketentuan</b> Pembelian Kavling tersebut di atas</p>
                    <button id="pay-button" type="submit" onclick="this.disabled=true; this.form.submit();" class="bg-blue-600 mt-4 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Pesan & Bayar DP
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection