@extends('landing.layouts.app')

@section('content')
    <div class="p-4">
        <div class="flex justify-center">
            <h1 class="font-semibold text-2xl mb-8 mt-4">Kebijakan Privasi</h1>
        </div>
        <div class="lg:mx-20">
            <p>Selamat datang di <span class="font-bold italic">Ticketify!</span> Kami sangat menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi Anda sesuai dengan Undang-Undang No. 27 Tahun 2022 tentang Perlindungan Data Pribadi (UU PDP) di Indonesia. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, mengungkapkan, dan melindungi informasi pribadi yang Anda berikan saat menggunakan layanan kami.</p>

            <h2 class="mt-4 font-bold">1. Informasi yang Kami Kumpulkan</h2>

            <h3 class="mt-4 font-semibold ml-2">1.1. Informasi Pribadi</h3>
            <ul class="list-disc pl-7">
                <li><strong>Identitas:</strong> Nama lengkap, nomor KTP, tanggal lahir, jenis kelamin, dan informasi identitas lainnya.</li>
                <li><strong>Kontak:</strong> Alamat email, nomor telepon, alamat pengiriman, dan alamat penagihan.</li>
                <li><strong>Akun:</strong> Nama pengguna, kata sandi, dan detail akun lainnya.</li>
            </ul>

            <h3 class="mt-4 font-semibold ml-2">1.2. Informasi Pembayaran</h3>
            <ul class="list-disc pl-7">
                <li><strong>Detail Pembayaran:</strong> Nomor kartu kredit atau debit, tanggal kedaluwarsa, CVV, dan informasi pembayaran lainnya. Kami bekerja sama dengan pihak ketiga tepercaya untuk memproses transaksi pembayaran Anda.</li>
                <li><strong>Riwayat Pembelian:</strong> Informasi mengenai tiket yang Anda beli, jumlah transaksi, serta tanggal dan waktu pembelian.</li>
            </ul>

            <h3 class="mt-4 font-semibold ml-2">1.3. Informasi Teknis</h3>
            <ul class="list-disc pl-7">
                <li><strong>Perangkat dan Koneksi:</strong> Informasi tentang perangkat yang Anda gunakan untuk mengakses situs kami, termasuk alamat IP, jenis perangkat, sistem operasi, dan jenis serta versi browser.</li>
                <li><strong>Log Aktivitas:</strong> Catatan aktivitas Anda di situs kami, seperti halaman yang dikunjungi, waktu akses, dan tindakan yang diambil.</li>
            </ul>

            <h3 class="mt-4 font-semibold ml-2">1.4. Informasi Tambahan</h3>
            <ul class="list-disc pl-7">
                <li><strong>Lokasi:</strong> Data lokasi Anda jika Anda mengaktifkan fitur berbasis lokasi pada perangkat Anda.</li>
                <li><strong>Media Sosial:</strong> Informasi yang Anda izinkan untuk dibagikan dari akun media sosial Anda saat menghubungkan akun tersebut dengan akun Ticketify.</li>
            </ul>

            <h2 class="mt-8 font-bold">2. Dasar Hukum Pengolahan Data</h2>
            <p class="mt-2 ml-2">Pengumpulan dan pemrosesan data pribadi Anda dilakukan berdasarkan ketentuan hukum yang berlaku, termasuk:</p>
            <ul class="list-disc pl-7 ml-2">
                <li><strong>Persetujuan:</strong> Kami akan meminta persetujuan Anda sebelum mengumpulkan atau memproses data pribadi Anda.</li>
                <li><strong>Kewajiban Kontrak:</strong> Untuk memenuhi kewajiban kami berdasarkan kontrak dengan Anda, seperti untuk memproses pembelian tiket.</li>
                <li><strong>Kepentingan Sah:</strong> Untuk kepentingan sah kami dalam mengelola dan mengoptimalkan layanan kami, asalkan kepentingan ini tidak mengesampingkan hak dan kebebasan Anda.</li>
            </ul>

            <h2 class="mt-8 font-bold">3. Bagaimana Kami Menggunakan Informasi Anda</h2>
            <p class="mt-2 ml-2">Kami menggunakan informasi yang kami kumpulkan untuk berbagai tujuan berikut:</p>

            <h3 class="mt-4 font-semibold ml-2">3.1. Penyediaan Layanan</h3>
            <ul class="list-disc pl-7 ml-2">
                <li><strong>Transaksi Pembelian:</strong> Memproses pembelian tiket Anda dan mengelola layanan terkait.</li>
                <li><strong>Personalisasi:</strong> Menyediakan konten yang dipersonalisasi berdasarkan preferensi dan aktivitas Anda di situs kami.</li>
            </ul>

            <h3 class="mt-4 font-semibold ml-2">3.2. Komunikasi</h3>
            <ul class="list-disc pl-7 ml-2">
                <li><strong>Konfirmasi Transaksi:</strong> Mengirimkan konfirmasi pembelian, informasi acara, dan pembaruan lainnya melalui email, SMS, atau metode komunikasi lainnya.</li>
                <li><strong>Dukungan Pelanggan:</strong> Menyediakan dukungan pelanggan untuk menangani pertanyaan, keluhan, dan bantuan lainnya.</li>
            </ul>

            <h3 class="mt-4 font-semibold ml-2">3.3. Pengembangan dan Analisis</h3>
            <ul class="list-disc pl-7 ml-2">
                <li><strong>Peningkatan Layanan:</strong> Menganalisis penggunaan layanan kami untuk mengidentifikasi area yang dapat ditingkatkan.</li>
                <li><strong>Pengembangan Produk:</strong> Mengembangkan dan memperkenalkan fitur atau layanan baru yang relevan dengan kebutuhan pengguna.</li>
            </ul>

            <h3 class="mt-4 font-semibold ml-2">3.4. Keamanan dan Kepatuhan</h3>
            <ul class="list-disc pl-7 ml-2">
                <li><strong>Keamanan Data:</strong> Mengamankan data pribadi Anda dan melindungi situs kami dari aktivitas yang tidak sah atau berbahaya.</li>
                <li><strong>Kepatuhan Hukum:</strong> Mematuhi kewajiban hukum yang berlaku, termasuk persyaratan dari instansi pemerintah.</li>
            </ul>

            <h2 class="mt-8 font-bold">4. Pengungkapan Informasi Anda</h2>
            <p class="mt-2 ml-2">Kami dapat mengungkapkan informasi pribadi Anda kepada pihak ketiga dalam kondisi berikut:</p>

            <h3 class="mt-4 font-semibold ml-2">4.1. Penyedia Layanan Pihak Ketiga</h3>
            <ul class="list-disc pl-7 ml-2">
                <li><strong>Pemrosesan Pembayaran:</strong> Mitra pembayaran yang menangani transaksi finansial Anda secara aman.</li>
                <li><strong>Layanan Teknis:</strong> Penyedia hosting, penyimpanan data, dan teknologi lain yang mendukung operasi situs kami.</li>
                <li><strong>Analisis Data:</strong> Penyedia layanan analisis yang membantu kami memahami perilaku pengguna untuk meningkatkan layanan kami.</li>
            </ul>

            <h3 class="mt-4 font-semibold ml-2">4.2. Kewajiban Hukum dan Penegakan Hukum</h3>
            <ul class="list-disc pl-7 ml-2">
                <li><strong>Kepatuhan Hukum:</strong> Memenuhi persyaratan hukum atau peraturan yang berlaku.</li>
                <li><strong>Penegakan Hak:</strong> Melindungi hak, properti, atau keselamatan Ticketify, pengguna kami, atau pihak ketiga.</li>
            </ul>

            <h3 class="mt-4 font-semibold ml-2">4.3. Transfer Bisnis</h3>
            <p class="mt-2 ml-2">Dalam hal terjadi merger, akuisisi, atau penjualan sebagian atau seluruh aset kami, informasi pribadi Anda mungkin menjadi salah satu aset yang ditransfer kepada pihak ketiga.</p>

            <h2 class="mt-8 font-bold">5. Keamanan Data Pribadi</h2>
            <p class="mt-2 ml-2">Kami berkomitmen untuk menjaga keamanan data pribadi Anda melalui langkah-langkah berikut:</p>

            <h3 class="mt-4 font-semibold ml-2">5.1. Teknologi Keamanan</h3>
            <ul class="list-disc pl-7 ml-2">
                <li><strong>Enkripsi:</strong> Menggunakan enkripsi untuk melindungi data selama transmisi melalui internet.</li>
                <li><strong>Keamanan Sistem:</strong> Menerapkan langkah-langkah keamanan seperti firewall dan sistem deteksi intrusi untuk melindungi data dari akses yang tidak sah.</li>
            </ul>

            <h3 class="mt-4 font-semibold ml-2">5.2. Kebijakan dan Prosedur Internal</h3>
            <ul class="list-disc pl-7 ml-2">
                <li><strong>Akses Terbatas:</strong> Akses ke data pribadi Anda dibatasi hanya kepada karyawan yang memerlukan informasi tersebut untuk menjalankan tugas mereka.</li>
                <li><strong>Pelatihan Keamanan:</strong> Kami memberikan pelatihan kepada staf kami tentang pentingnya menjaga privasi dan keamanan data.</li>
            </ul>

            <p class="mt-2 ml-2">Meskipun kami telah mengambil langkah-langkah untuk melindungi informasi pribadi Anda, perlu diingat bahwa tidak ada metode penyimpanan atau transmisi data yang sepenuhnya aman. Oleh karena itu, kami tidak dapat menjamin keamanan absolut data Anda.</p>

            <h2 class="mt-8 font-bold">6. Hak Anda sebagai Pemilik Data</h2>
            <p class="mt-2 ml-2">Berdasarkan UU PDP, Anda memiliki hak-hak tertentu terkait data pribadi Anda, termasuk:</p>

            <h3 class="mt-4 font-semibold ml-2">6.1. Hak untuk Mengakses</h3>
            <p class="mt-2 ml-2">Anda berhak untuk meminta informasi tentang data pribadi yang kami miliki tentang Anda dan untuk memperoleh salinan dari data tersebut.</p>

            <h3 class="mt-4 font-semibold ml-2">6.2. Hak untuk Mengoreksi</h3>
            <p class="mt-2 ml-2">Anda dapat meminta kami untuk memperbarui atau memperbaiki data pribadi Anda jika terdapat ketidakakuratan atau perubahan dalam data tersebut.</p>

            <h3 class="mt-4 font-semibold ml-2">6.3. Hak untuk Menghapus</h3>
            <p class="mt-2 ml-2">Anda dapat meminta penghapusan data pribadi Anda dalam kondisi tertentu, misalnya jika data tersebut tidak lagi diperlukan untuk tujuan pengumpulannya.</p>

            <h3 class="mt-4 font-semibold ml-2">6.4. Hak untuk Menolak Pemrosesan</h3>
            <p class="mt-2 ml-2">Anda berhak untuk menolak pemrosesan data pribadi Anda jika pemrosesan tersebut dilakukan berdasarkan kepentingan sah kami atau untuk tujuan pemasaran langsung.</p>

            <h3 class="mt-4 font-semibold ml-2">6.5. Hak untuk Menarik Persetujuan</h3>
            <p class="mt-2 ml-2">Jika pemrosesan data pribadi Anda didasarkan pada persetujuan Anda, Anda berhak untuk menarik persetujuan tersebut kapan saja. Penarikan persetujuan tidak mempengaruhi keabsahan pemrosesan berdasarkan persetujuan sebelum penarikan.</p>

            <h2 class="mt-8 font-bold">7. Penggunaan Cookie dan Teknologi Serupa</h2>
            <p class="mt-2 ml-2">Kami menggunakan cookie dan teknologi serupa untuk meningkatkan pengalaman pengguna di situs kami. Ini termasuk:</p>

            <h3 class="mt-4 font-semibold ml-2">7.1. Jenis Cookie yang Digunakan</h3>
            <ul class="list-disc pl-7 ml-2">
                <li><strong>Cookie Esensial:</strong> Cookie yang diperlukan untuk fungsi dasar situs kami, seperti login dan penyimpanan preferensi pengguna.</li>
                <li><strong>Cookie Analitik:</strong> Cookie yang membantu kami menganalisis penggunaan situs dan meningkatkan fungsionalitasnya.</li>
                <li><strong>Cookie Pemasaran:</strong> Cookie yang digunakan untuk menargetkan iklan dan promosi yang relevan bagi Anda.</li>
            </ul>

            <h3 class="mt-4 font-semibold ml-2">7.2. Mengelola Cookie</h3>
            <p class="mt-2 ml-2">Anda dapat mengelola preferensi cookie Anda melalui pengaturan browser Anda. Menonaktifkan cookie tertentu dapat mempengaruhi fungsionalitas situs kami dan pengalaman pengguna Anda.</p>

            <h2 class="mt-8 font-bold">8. Retensi Data</h2>
            <p class="mt-2 ml-2">Kami hanya menyimpan data pribadi Anda selama diperlukan untuk memenuhi tujuan pengumpulannya atau selama diwajibkan oleh hukum. Setelah periode retensi berakhir, kami akan menghapus atau menganonimkan data Anda sesuai dengan kebijakan retensi data kami.</p>

            <h2 class="mt-8 font-bold">9. Transfer Internasional</h2>
            <p class="mt-2 ml-2">Jika kami mentransfer data pribadi Anda ke luar Indonesia, kami akan memastikan bahwa data tersebut dilindungi dengan standar keamanan yang setara dengan yang diharuskan oleh UU PDP. Transfer data akan dilakukan sesuai dengan persyaratan peraturan yang berlaku.</p>

            <h2 class="mt-8 font-bold">10. Kebijakan Privasi untuk Anak-anak</h2>
            <p class="mt-2 ml-2">Layanan kami tidak ditujukan untuk anak-anak di bawah usia 13 tahun. Kami tidak secara sadar mengumpulkan informasi pribadi dari anak-anak tanpa izin dari orang tua atau wali. Jika kami mengetahui bahwa kami telah mengumpulkan data pribadi dari anak-anak tanpa persetujuan yang diperlukan, kami akan mengambil langkah untuk menghapus data tersebut.</p>

            <h2 class="mt-8 font-bold">11. Perubahan Kebijakan Privasi</h2>
            <p class="mt-2 ml-2">Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu untuk mencerminkan perubahan pada praktik kami atau untuk mematuhi peraturan yang berlaku. Kami akan memberi tahu Anda tentang perubahan penting melalui email atau pemberitahuan di situs kami.</p>
        </div>
    </div>
@endsection