@extends('master')
@section('main')
<section class="w-3/4">
    <div class="flex flex-col md:flex-row gap-8">
        <div class="md:w-full bg-white">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-4">
                <span id="main-title">Lokasi Kavling</span>
            </h1>
            <div id="main-content" class="text-gray-700 leading-relaxed">
                <p class="mb-4">
                    Kami menyediakan berbagai kavling di beberapa daerah di Provinsi Banten, dan berikut informasi sementara wilayah mana saja yang terdapat lahan kavling kami.
                </p>
                <ul class="list-disc list-inside ml-4 space-y-1">
                    <li>Kota Serang</li>
                </ul>
                <p class="mt-6 text-sm text-gray-600">
                    Nama-nama lokasi tersebut di atas adalah lokasi yang tersedia sementara, namun kedepannya kami akan menampilkan seluruh wilayah di Indonesia.
                </p>
            </div>
        </div>

        <div class="md:w-fit bg-white ml-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Informasi</h2>
            <nav>
                <ul class="space-y-3">
                    <li>
                        <a href="#" data-content-id="lokasi-kavling" class="sidebar-link block text-sm text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200">Lokasi Kavling</a>
                    </li>
                    <li>
                        <a href="#" data-content-id="syarat-ketentuan" class="sidebar-link block text-sm text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200">Syarat dan Ketentuan</a>
                    </li>
                    <li>
                        <a href="#" data-content-id="mekanisme-kepemilikan" class="sidebar-link block text-sm text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200">Mekanisme Kepemilikan</a>
                    </li>
                    <li>
                        <a href="#" data-content-id="konfirmasi-pembayaran" class="sidebar-link block text-sm text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200">Konfirmasi Pembayaran</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            const mainTitle = document.getElementById('main-title');
            const mainContent = document.getElementById('main-content');

            const contentData = {
                'lokasi-kavling': {
                    title: 'Lokasi Kavling',
                    html: `
                        <p class="mb-4">
                            Kami menyediakan berbagai kavling di beberapa daerah di pulau Kalimantan, dan berikut informasi sementara wilayah mana saja yang terdapat lahan kavling kami.
                        </p>
                        <ul class="list-disc list-inside ml-4 space-y-1">
                            <li>Banten</li>
                        </ul>
                        <p class="mt-6 text-sm text-gray-600">
                            Nama-nama lokasi tersebut di atas adalah lokasi yang tersedia sementara, namun kedepannya kami akan menampilkan seluruh wilayah di Indonesia.
                        </p>
                    `
                },
                'syarat-ketentuan': {
                    title: 'Syarat dan Ketentuan',
                    html: `
                        <p>Berikut adalah syarat dan ketentuan yang berlaku untuk kepemilikan kavling:</p>
                        <ul class="list-disc list-inside ml-4 space-y-2 mt-4">
                            <li>Warga Negara Indonesia (WNI) berusia minimal 21 tahun.</li>
                            <li>Melengkapi dokumen identitas diri (KTP, KK).</li>
                            <li>Pembayaran uang muka sesuai ketentuan.</li>
                            <li>Menyetujui isi perjanjian jual beli kavling.</li>
                            <li>Kavling tidak dapat dipindahtangankan tanpa persetujuan pengembang.</li>
                        </ul>
                        <p class="mt-4">Untuk informasi lebih lanjut, silakan hubungi customer service kami.</p>
                    `
                },
                'mekanisme-kepemilikan': {
                    title: 'Mekanisme Kepemilikan',
                    html: `
                        <p>Proses kepemilikan kavling sangat mudah dan transparan:</p>
                        <ol class="list-decimal list-inside ml-4 space-y-2 mt-4">
                            <li>Pilih lokasi kavling yang Anda inginkan.</li>
                            <li>Lakukan booking fee untuk mengamankan unit.</li>
                            <li>Lengkapi administrasi dan dokumen yang dibutuhkan.</li>
                            <li>Pilih skema pembayaran (cash, cicilan bertahap, KPR).</li>
                            <li>Penandatanganan Akta Jual Beli (AJB) dan serah terima surat-surat.</li>
                            <li>Kavling resmi menjadi milik Anda.</li>
                        </ol>
                        <p class="mt-4">Kami akan memandu Anda di setiap langkah proses ini.</p>
                    `
                },
                'konfirmasi-pembayaran': {
                    title: 'Konfirmasi Pembayaran',
                    html: `
                        <p>Setelah melakukan pembayaran, mohon lakukan konfirmasi agar pembayaran Anda segera kami proses:</p>
                        <ul class="list-disc list-inside ml-4 space-y-2 mt-4">
                            <li>Kirim bukti transfer/pembayaran melalui WhatsApp ke nomor: <strong>+62 812-XXXX-XXXX</strong></li>
                            <li>Sertakan nama lengkap, nomor kavling (jika ada), dan jumlah pembayaran.</li>
                            <li>Pembayaran akan diverifikasi dalam waktu 1x24 jam kerja.</li>
                            <li>Anda akan menerima notifikasi setelah pembayaran berhasil diverifikasi.</li>
                        </ul>
                        <p class="mt-4">Terima kasih atas kepercayaan Anda.</p>
                    `
                }
            };

            sidebarLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent default anchor link behavior
                    const contentId = this.dataset.contentId;
                    const selectedContent = contentData[contentId];

                    if (selectedContent) {
                        mainTitle.textContent = selectedContent.title;
                        mainContent.innerHTML = selectedContent.html;

                        // Optional: Add/remove active class for styling the selected link
                        sidebarLinks.forEach(item => item.classList.remove('font-bold', 'text-blue-800'));
                        this.classList.add('font-bold', 'text-blue-800');
                    }
                });
            });

            // Set initial active link style
            document.querySelector('[data-content-id="lokasi-kavling"]').classList.add('font-bold', 'text-blue-800');
        });
    </script>
</section>
@endsection