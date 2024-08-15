@extends('landing.layouts.app')

@section('content')
    <!-- hero -->
    <div class="container mx-auto px-4 py-8">
        <h1 class="font-bold text-4xl mb-8">{{ $event->event_name }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex flex-col items-center">
                <div class="relative flex justify-center">
                    <img src="{{ asset('storage/' . $event->event_picture) }}"
                        class="w-full h-full object-cover rounded-t-2xl" alt="Event Image" />
                </div>
                <div class="bg-[#535355] rounded-b-2xl p-4 text-gray-700 flex justify-between items-center w-full ">
                    <div class="text-white">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        {{ \Carbon\Carbon::parse($event->event_start)->translatedFormat('j F Y') }}
                    </div>
                    <div class="text-white">
                        <i class="fas fa-map-marker-alt mr-2"></i>{{ $event->event_location }}
                    </div>
                </div> 
            </div>           
            <div class="bg-white p-6 rounded-2xl border-2 border-black">
                <h3 class="text-4xl font-semibold mb-8">Ticket Categories</h3>
                <div class="space-y-2">
                    @if($tickets->isEmpty())
                    <h1 class="text-3xl text-center font-bold text-gray-900">Oops! Ticket tidak ada.</h1>
                    @else
                    @foreach ($tickets as $ticket)
                        <div class="flex items-center p-2 border bg-[#535355] rounded-xl">
                            <div class="flex-1">
                                <div class="text-white pl-2">{{ $ticket->ticket_type }}</div>
                                <div class="text-white pl-2">Rp {{ number_format($ticket->price, 0, ',', '.') }}</div>
                            </div>
                            <button onclick="window.location.href='{{ route('order', ['event_id' => $event->event_id, 'ticket_id' => $ticket->ticket_id]) }}'"
                                class="ml-4 bg-white text-black px-8 py-2 rounded-xl">Add</button>                            
                        </div>
                    @endforeach 
                    @endif
                </div>
                
            </div>
        </div>
    </div>
    <!-- end hero -->

    <!-- description -->
    <section class="container md:px-32 md:py-10 py-7 px-4">
        <div class="flex flex-col text-wrap md:ml-16">
            <h1 class="text-4xl font-bold mb-4">Description</h1>
            <p class="text-xl">
                {{ $event->event_description }}
            </p>
        </div>
    </section>
    <!-- end description -->

@endsection
