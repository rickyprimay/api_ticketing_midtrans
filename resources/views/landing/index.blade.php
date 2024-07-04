@extends('landing.layouts.app')

@section('content')
    <section class="container mx-auto text-center bg-white px-4 md:px-0 pt-24 md:pt-32">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Unlocking Unforgettable <br />
                Experience
            </h1>
            <a href="#to_ticket">
                <button
                    class="bg-orange-500 text-white py-2 px-4 rounded-full hover:bg-orange-600 transition duration-300">Buy
                    Ticket Now</button>
            </a>
            <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4 pt-9">
                <button class="bg-[#141414] text-white py-2 px-4 rounded-full">Online Ticketing</button>
                <button class="bg-[#141414] text-white py-2 px-4 rounded-full">Concert</button>
                <button class="bg-[#141414] text-white py-2 px-4 rounded-full">Event Management</button>
            </div>
        </div>
    </section>
    <section class="container mx-auto px-4 md:px-8 mt-8 md:mt-16">
        <div id="controls-carousel" class="relative w-full" data-carousel="static">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('assets/img/carousel/carousels1.svg') }}"
                        class="absolute block w-full h-full object-cover object-center" alt="..." />
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img src="{{ asset('assets/img/carousel/carousels2.svg') }}"
                        class="absolute block w-full h-full object-cover object-center" alt="..." />
                </div>
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </section>
    {{-- end carousel --}}
    <!-- card -->
    <div class="container mx-auto p-4 mb-5">
        <!-- Filter and Search Buttons -->

        <div class="flex justify-between px-0 md:px-16 mb-4">
            <form action="{{ route('events.search') }}" method="GET" class="flex">
                <input type="text" name="search" placeholder="Cari events..."
                    class="bg-white border-2 border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-blue-300">
                <button type="submit" class="bg-black text-white p-2 ml-2 rounded">Search</button>
            </form>
        </div>

        <!-- Card Grid -->
        @if ($events->isEmpty())
            <h1 class="text-3xl text-center font-bold text-gray-900">Oops! Event yang Anda cari tidak ditemukan.</h1>
        @else
            <div id="to_ticket" class="grid grid-cols-1 md:grid-cols-2 gap-2 place-items-center">
                @foreach ($events as $event)
                    <a href="{{ route('event_details', ['event_id' => $event->event_id]) }}">
                        <div class="card bg-white">
                            <div class="imgDisplay">
                                <div class="relative pb-[56.25%] bg-gray-200">
                                    <img src="{{ asset('storage/event_pictures/' . $event->event_picture) }}" alt="Event"
                                        class="absolute h-full w-full object-cover" />
                                </div>
                                <div class="y-date-boxInfo bg-orange-500">
                                    <div class="y-date-month text-white">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('M') }}
                                    </div>
                                    <div class="y-date-day text-orange-500">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d') }}
                                    </div>
                                </div>
                            </div>
                            <div class="y-card-title">
                                <p class="boxTitle">{{ $event->event_name }} - {{ $event->event_location }}</p>
                                <p class="boxAddress">{{ $event->event_location }}</p>
                                <hr class="y-separator" />
                                <p class="boxInfo">Start From <span
                                        class="boxPrice">Rp&nbsp;{{ number_format($event->price, 0, ',', '.') }}</span></p>
                            </div>
                        </div>
                    </a>
                @endforeach



            </div>
        @endif


    </div>

    <!-- end card -->
@endsection
