@extends('auth.layouts.app')

@section('content')
    <section>
        <div class="bg-[#454545] dark:bg-[#454545] flex justify-center items-center h-screen">
            <div class="lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">
                <div class="flex flex-col items-center mb-8">
                    <img src="{{ asset('assets/img/logo/logo.svg') }}" alt="Logo" />
                    <h1 class="text-2xl font-semibold text-white">Welcome!</h1>
                </div>
                <form action="{{ route('auth.register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="text-white mb-1 flex flex-start">Username</label>
                        <input type="text" id="name" name="name"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            autocomplete="off" placeholder="Enter your username" required>
                    </div>
                    <div class="mb-4">
                        
                        <label for="email" class="text-white mb-1 flex flex-start">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                            autocomplete="off" placeholder="example@gmail.com" required>
                        @if ($errors->has('email'))
                            <span class="text-red-500 text-sm">{{ $errors->first('email') }}</span>
                        @endif
                        <div class="flex items-center p-4 mb-4 mt-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                              <span class="font-medium">Peringatan!</span> Pastikan email sesuai dengan email anda.
                            </div>
                          </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="text-white mb-1 flex flex-start">Password</label>
                        <div class="relative w-full">
                            <input id="password" name="password"
                                class="w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500"
                                autocomplete="off" placeholder="••••••••" type="password" required>
                            @if ($errors->has('password'))
                                <span class="text-red-500 text-sm">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <button type="submit"
                        class="bg-orange-200 text-black font-semibold rounded-md py-2 px-4 w-full">Continue</button>
                </form>
                <div class="mt-6 text-white text-center flex justify-center">
                    <span>Already have an account?</span>
                    <a href="{{ route('auth.login') }}" class="text-orange-200 ml-2">Login</a>
                </div>
            </div>
            <div class="w-1/2 h-screen hidden lg:block">
                <img src="{{ asset('assets/img/logo/ck-bg.svg') }}" alt="Placeholder Image" class="object-cover w-full h-full" />
            </div>
        </div>
    </section>
@endsection
