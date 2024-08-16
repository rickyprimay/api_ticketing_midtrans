@extends('landing.layouts.app')

@section('content')
    <div class="p-4">
        <div class="flex justify-center">
            <h1 class="font-semibold text-2xl mb-8 mt-4">Syarat dan Ketentuan</h1>
        </div>
        <div class="lg:mx-20">
            <p>Selamat datang di <span class="font-bold italic">Ticketify!</span> Syarat dan Ketentuan ini mengatur penggunaan Anda atas situs web dan layanan kami. Dengan mengakses atau menggunakan situs web kami, Anda setuju untuk terikat oleh Syarat dan Ketentuan ini. Jika Anda tidak setuju dengan salah satu bagian dari Syarat dan Ketentuan ini, harap jangan menggunakan layanan kami.</p>
            
            <h2 class="mt-4 font-bold">1. Definisi</h2>
            <p class="mt-2">“Situs Web” merujuk pada situs web Ticketify di www.ticketify.id.</p>
            <p>“Layanan” mencakup penjualan tiket acara, termasuk namun tidak terbatas pada, konser, pertunjukan, dan acara olahraga yang disediakan melalui situs web kami.</p>
            <p>“Pengguna” merujuk pada setiap individu yang mengakses atau menggunakan layanan kami.</p>
            <p>“Penyelenggara Acara” merujuk pada pihak ketiga yang bekerja sama dengan Ticketify untuk menjual tiket acara mereka melalui situs kami.</p>
            
            <h2 class="mt-4 font-bold">2. Kelayakan</h2>
            <p class="mt-2">Dengan menggunakan layanan kami, Anda menyatakan dan menjamin bahwa Anda:</p>
            <ul class="list-disc ml-6">
                <li>Berusia setidaknya 18 tahun atau memiliki izin dari orang tua atau wali jika berusia di bawah 18 tahun.</li>
                <li>Memiliki kapasitas hukum penuh untuk mengikatkan diri pada Syarat dan Ketentuan ini.</li>
            </ul>
            
            <h2 class="mt-4 font-bold">3. Penggunaan Layanan</h2>

            <h3 class="ml-2 mt-2 font-semibold">3.1 Akun Pengguna</h3>
            <ul class="list-disc ml-6">
                <li>Untuk membeli tiket melalui Ticketify, Anda harus membuat akun dengan memberikan informasi yang akurat dan lengkap.</li>
                <li>Anda bertanggung jawab untuk menjaga kerahasiaan detail akun Anda, termasuk kata sandi, dan bertanggung jawab atas semua aktivitas yang terjadi di bawah akun Anda.</li>
                <li>Anda setuju untuk segera memberi tahu kami jika terjadi penggunaan yang tidak sah atas akun Anda atau pelanggaran keamanan lainnya.</li>
            </ul>

            <h3 class="ml-2 mt-2 font-semibold">3.2 Pembelian Tiket</h3>
            <ul class="list-disc ml-6">
                <li>Semua pembelian tiket melalui situs kami bersifat final dan tidak dapat dibatalkan, kecuali jika secara tegas dinyatakan lain oleh Penyelenggara Acara atau dalam hukum yang berlaku.</li>
                <li>Harga tiket dapat berubah sewaktu-waktu sebelum pembelian selesai dan dapat dikenakan biaya tambahan seperti biaya pemesanan atau biaya layanan. Setelah pembelian berhasil, Anda akan menerima email konfirmasi yang berisi detail tiket. Anda bertanggung jawab untuk memverifikasi bahwa semua informasi yang terdapat dalam email konfirmasi benar.</li>
            </ul>

            <h3 class="ml-2 mt-2 font-semibold">3.3 Penggunaan Tiket</h3>
            <ul class="list-disc ml-6">
                <li>Tiket yang dibeli hanya berlaku untuk acara dan tanggal yang ditentukan dan tidak dapat dipindahtangankan kecuali diizinkan oleh Penyelenggara Acara.</li>
                <li>Pengguna diwajibkan untuk mengikuti aturan dan kebijakan Penyelenggara Acara, termasuk kebijakan masuk dan kebijakan terkait keselamatan. Ticketify tidak bertanggung jawab atas penolakan akses ke acara jika tiket tidak sesuai dengan kebijakan Penyelenggara Acara.</li>
            </ul>

            <h2 class="mt-4 font-bold">4. Pembatalan dan Pengembalian Dana</h2>
            <p class="mt-2">Dalam hal acara dibatalkan atau ditunda, kebijakan pengembalian dana akan mengikuti ketentuan yang ditetapkan oleh Penyelenggara Acara. Ticketify akan membantu dalam proses pengembalian dana sesuai dengan instruksi dari Penyelenggara Acara, namun kami tidak bertanggung jawab atas keputusan akhir terkait pengembalian dana.</p>

            <h2 class="mt-4 font-bold">5. Tanggung Jawab Pengguna</h2>
            <ul class="list-disc ml-6 mt-2">
                <li>Anda setuju untuk menggunakan situs web kami hanya untuk tujuan yang sah dan sesuai dengan Syarat dan Ketentuan ini.</li>
                <li>Anda tidak boleh menggunakan layanan kami untuk tujuan komersial tanpa izin tertulis dari Ticketify.</li>
                <li>Anda tidak boleh menggunakan layanan kami untuk melakukan tindakan yang melanggar hukum, menipu, atau merugikan pihak lain.</li>
            </ul>

            <h2 class="mt-4 font-bold">6. Hak Kekayaan Intelektual</h2>
            <p class="mt-2">Semua konten yang tersedia di situs web Ticketify, termasuk namun tidak terbatas pada teks, grafis, logo, dan perangkat lunak, adalah milik Ticketify atau pihak ketiga yang telah memberikan lisensi kepada kami. Anda dilarang menyalin, mereproduksi, mendistribusikan, atau menggunakan konten tersebut tanpa izin tertulis dari pemilik hak cipta yang bersangkutan.</p>

            <h2 class="mt-4 font-bold">7. Pembatasan Tanggung Jawab</h2>
            <ul class="list-disc ml-6 mt-2">
                <li>Ticketify tidak bertanggung jawab atas kerugian atau kerusakan yang timbul dari penggunaan atau ketidakmampuan untuk menggunakan layanan kami, termasuk namun tidak terbatas pada, kegagalan teknis, virus komputer, atau akses tidak sah ke data pengguna.</li>
                <li>Ticketify tidak bertanggung jawab atas kualitas, ketepatan waktu, atau keberhasilan acara yang diselenggarakan oleh Penyelenggara Acara. Dalam hal apapun, tanggung jawab Ticketify kepada Anda terbatas pada jumlah yang Anda bayarkan untuk tiket yang bersangkutan.</li>
            </ul>

            <h2 class="mt-4 font-bold">8. Link ke Situs Web Pihak Ketiga</h2>
            <p class="mt-2">Situs web kami mungkin mengandung link ke situs web pihak ketiga yang tidak dioperasikan atau dikendalikan oleh Ticketify. Kami tidak bertanggung jawab atas konten, kebijakan privasi, atau praktik situs web pihak ketiga tersebut.</p>

            <h2 class="mt-4 font-bold">9. Perubahan Syarat dan Ketentuan</h2>
            <p class="mt-2">Ticketify berhak untuk mengubah atau memperbarui Syarat dan Ketentuan ini dari waktu ke waktu. Kami akan memberi tahu Anda tentang perubahan penting melalui email atau pemberitahuan di situs web kami. Penggunaan berkelanjutan Anda atas layanan kami setelah perubahan tersebut menunjukkan persetujuan Anda terhadap Syarat dan Ketentuan yang diperbarui.</p>

            <h2 class="mt-4 font-bold">10. Hukum yang Berlaku</h2>
            <p class="mt-2">Syarat dan Ketentuan ini diatur oleh dan ditafsirkan sesuai dengan hukum Republik Indonesia. Setiap perselisihan yang timbul dari atau terkait dengan Syarat dan Ketentuan ini akan diselesaikan di pengadilan yang berwenang di Indonesia.</p>
        </div>
    </div>
@endsection
