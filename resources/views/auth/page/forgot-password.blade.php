@extends('auth.layouts.app')

@section('content')
<section>
    <div class="bg-[#454545] dark:bg-[#454545] flex justify-center items-center h-screen">
        <div class="lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">
            <div class="flex flex-col items-center mb-8">
                <img src="{{ asset('assets/img/logo/logo.svg') }}" alt="Logo" />
                <h1 class="text-2xl font-semibold text-white">Forgot Password?</h1>
            </div>
            <form action="{{ route('auth.forgot.password') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="text-white mb-1 flex flex-start">Email</label>
                    <input type="text" id="email" name="email" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off" />
                </div>
                <button type="submit" class="bg-orange-200 text-black font-semibold rounded-md py-2 px-4 w-full">Send Reset Link</button>
            </form>
            <div class="mt-6 text-white text-center flex justify-center">
                <span>Remember your password?</span>
                <a href="{{ route('auth.login') }}" class="text-orange-200 ml-2">Login</a>
            </div>
        </div>
        <div class="w-1/2 h-screen hidden lg:block">
            <img src="{{ asset('assets/img/logo/ck-bg.svg') }}" alt="Placeholder Image" class="object-cover w-full h-full" />
        </div>
    </div>
</section>
@endsection
