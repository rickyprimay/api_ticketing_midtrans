@extends('auth.layouts.app')

@section('content')
<section>
    <div class="bg-[#454545] dark:bg-[#454545] flex justify-center items-center h-screen">
        <div class="lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">
            <div class="flex flex-col items-center mb-8">
                <img src="{{ asset('assets/img/logo/logo.svg') }}" alt="Logo" />
                <h1 class="text-2xl font-semibold text-white">Reset Password</h1>
            </div>
            <form action="{{ route('auth.reset.password') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ Request::route('token') }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="mb-4">
                    <label for="password" class="text-white mb-1 flex flex-start">New Password</label>
                    <input id="password" name="password" type="password" class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500" autocomplete="off" />
                </div>
                <button type="submit" class="bg-orange-200 text-black font-semibold rounded-md py-2 px-4 w-full">Reset Password</button>
            </form>
        </div>
        <div class="w-1/2 h-screen hidden lg:block">
            <img src="{{ asset('assets/img/logo/ck-bg.svg') }}" alt="Placeholder Image" class="object-cover w-full h-full" />
        </div>
    </div>
</section>
@endsection
