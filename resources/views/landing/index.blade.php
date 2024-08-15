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
    
    @include('landing.components.carousel')
    <!-- card -->
    <div id="event-list" class="container mx-auto p-4 mb-5">
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
        <div id="to_ticket" class="grid grid-cols-1 md:grid-cols-3 gap-4 place-items-center">
            @foreach ($events as $event)
                @php
                    $aosAnimation = '';
                    if ($loop->index % 3 == 0) {
                        $aosAnimation = 'fade-right';
                    } elseif ($loop->index % 3 == 1) {
                        $aosAnimation = 'fade-up';
                    } elseif ($loop->index % 3 == 2) {
                        $aosAnimation = 'fade-left';
                    }
                @endphp
        
                <a data-aos="{{ $aosAnimation }}" href="{{ route('event_details', ['event_id' => $event->event_id]) }}" class="w-full max-w-xs mb-6 shadow-xl rounded-lg transform transition-transform duration-300 hover:-translate-y-2">
                    <div class="max-w-xs bg-white rounded-xl shadow-xl overflow-hidden p-2 pt-2">
                        <!-- Image and Date Badge -->
                        <div class="relative pt-2">
                            <img src="https://via.placeholder.com/300x150" alt="{{ $event->event_name }}" class="w-full h-40 object-cover rounded-t-lg" />
                            <div class="absolute top-2 right-2 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-lg">
                                <div class="text-center">
                                    <span class="text-sm">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span><br>
                                    <span class="text-lg">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                                </div>
                            </div>
                        </div>
        
                        <!-- Price Section -->
                        <div class="px-4 py-2 bg-[#EA784C] flex justify-between items-center rounded-b-xl">
                            <span class="text-white text-sm font-semibold">Start From</span>
                            <span class="text-[#FFD768] text-xl font-bold">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                        </div>
        
                        <!-- Title and Location -->
                        <div class="p-4">
                            <div class="text-lg font-semibold text-gray-900 text-center">{{ $event->event_name }}</div>
                            <div class="text-sm text-gray-600 text-center">{{ $event->event_location }}</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
            @if ($events->hasMorePages())
                <div class="text-center">
                    <button id="load-more" class="bg-orange-500 text-white py-2 px-4 rounded-full hover:bg-orange-600 transition duration-300" data-page="{{ $events->currentPage() + 1 }}">Load More</button>
                </div>
            @endif
        @endif
    </div>
    <!-- end card -->

    <script>
        $(document).ready(function() {
            $('#load-more').on('click', function() {
                let page = $(this).data('page');
                $.ajax({
                    url: '{{ route('events.load.more') }}',
                    method: 'GET',
                    data: {
                        page: page
                    },
                    success: function(response) {
                        $('#to_ticket').append(response); // Change to append to the correct element
                        $('#load-more').data('page', page + 1);
                        // Hide button if no more pages
                        if (!response.trim()) {
                            $('#load-more').hide();
                        }
                    }
                });
            });
        });
    </script>
@endsection