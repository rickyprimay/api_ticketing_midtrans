@extends('landing.layouts.app')

@section('content')
    <!-- hero -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex justify-center pt-3">
                <img src="{{ asset('storage/' . $event->event_picture) }}"
                    class="w-[800px] h-[400px] object-cover" alt="Event Image" />
            </div>
            <div class="bg-white p-6 rounded-lg border-2 border-black">
                <h2 class="text-2xl font-bold mb-4">{{ $event->event_name }}</h2>
                <div class="text-gray-700 mb-4">
                    <p>{{ \Carbon\Carbon::parse($event->event_start)->translatedFormat('j F Y') }}-{{ \Carbon\Carbon::parse($event->event_ended)->translatedFormat('j F Y') }}</p>
                    <p>{{ $event->event_location }}</p>
                </div>
                <h3 class="text-xl font-semibold mt-8 mb-2">Ticket Categories</h3>
                <div class="space-y-2">
                    @foreach ($tickets as $ticket)
                        <div class="flex items-center p-2 border border-gray-300 rounded">
                            <div class="flex-1 truncate pr-4">{{ $ticket->ticket_type }}</div>
                            <div class="w-32 text-right">Rp {{ number_format($ticket->price, 0, ',', '.') }}</div>
                            <button onclick="window.location.href='{{ route('order', ['event_id' => $event->event_id, 'price' => $ticket->price]) }}'"
                                class="ml-4 bg-[#454545] text-white px-4 py-2 rounded">Pesan</button>                            
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
    <!-- end hero -->

    <!-- description -->
    <section class="container md:px-32 md:py-10 py-7 px-4">
        <div class="flex flex-col text-wrap md:ml-16">
            <h1 class="text-4xl font-bold mb-4">Deskripsi Event</h1>
            <p class="text-xl">
                {{ $event->event_description }}
            </p>
        </div>
    </section>
    <!-- end description -->

    <!-- lineup -->
    <div class="bg-amber-200 py-8">
        <div class="container mx-auto px-4 text-center">
            <button class="bg-black text-white px-4 py-2 rounded-lg mb-4">Line up</button>
            @if ($talents->isEmpty())
                <p class="text-gray-700">Coming Soon</p>
            @else
                <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                    @foreach ($talents as $talent)
                        <button class="bg-white py-2 rounded-lg">{{ $talent->name }}</button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!-- end lineup -->

@endsection
