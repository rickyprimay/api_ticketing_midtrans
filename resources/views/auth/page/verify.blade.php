@extends('auth.layouts.app')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-20 mr-2" src="{{ asset('assets/img/logo/logo.svg') }}" alt="logo">
            Ticketify
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Verifikasi OTP
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('auth.verify') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">
                    <div>
                        <label for="otp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan OTP</label>
                        <input type="text" name="otp" id="otp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan kode OTP 6 digit" required>
                    </div>
                    <button type="submit" class="mt-4 w-full text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Verifikasi</button>
                </form>
                @if (!session('email'))
                <div class="mt-4 text-sm text-red-600 dark:text-red-400">Silakan kembali ke halaman sebelumnya untuk memulai proses verifikasi.</div>
                @else
                <div id="resendSection" class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                    Kode tidak masuk? <a id="resendLink" href="#" onclick="event.preventDefault(); resendOTP();">Kirim Ulang</a>
                </div>
                
                <form id="resendForm" action="{{ route('auth.resend.otp') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">
                </form>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    function resendOTP() {
        var form = document.getElementById('resendForm');
        form.submit();
        
        var resendLink = document.getElementById('resendLink');
        resendLink.innerHTML = 'Kode tidak masuk? Mengirim ulang dalam 01:00';
        resendLink.removeAttribute('onclick');

        // Set countdown for 1 minute
        var countdown = 60;
        var countdownInterval = setInterval(function() {
            countdown--;
            resendLink.innerHTML = 'Kode tidak masuk? Mengirim ulang dalam ' + pad(countdown, 2) + ':00';
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                resendLink.innerHTML = 'Kode tidak masuk? <a href="#" onclick="resendOTP()">Kirim Ulang</a>';
            }
        }, 1000);
    }

    function pad(num, size) {
        var s = num + '';
        while (s.length < size) s = '0' + s;
        return s;
    }
</script>
@endsection
