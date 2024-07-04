@extends('landing.layouts.app')

@section('content')
    <!-- card -->
    <div class="container mx-auto p-4 mb-5">
        <h5 class="text-2xl font-bold tracking-tight text-black mb-4">Ticket History</h5>
        @if (isset($message))
            <h1 class="text-xl font-semibold text-center mt-[200px] mb-[200px]">Oops, there are no ticket records.</h1>
        @else
            {{-- <!-- Filter and Search Buttons -->
            <div class="flex justify-between px-0 md:px-28 mb-4">
                <button class="bg-black text-white p-2 rounded">Filters</button>
                <button class="bg-black text-white p-2 rounded">Search</button>
            </div> --}}

            <!-- Card Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 place-items-center">
                @foreach ($tickets_user as $ticket)
                    <!-- card -->
                    <a href="ticketdetailpage.html"
                        class="w-[320px] bg-white border-2 border-black rounded-lg shadow border-solid flex flex-col items-center">
                        <h5 class="mt-2 text-2xl font-bold tracking-tight text-black">E-Ticket</h5>
                        <img class="rounded-t-lg w-[300px] mt-4" src="{{ asset('storage/' . $ticket->qr_code_ticket) }}"
                            alt="qrcode" />
                            
                        <div class="p-5 text-center">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-black">{{ $ticket->event->event_name }}</h5>
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-black">Tunjukan QR Code ini ke panitia saat hari H</h5>
                            <p class="mb-3 font-normal text-gray-400">
                                {{ $ticket->event->event_location }}</p>
                            <p class="mb-3 font-normal text-gray-400">{{ $ticket->users_name }}</p>
                            <div class="flex justify-center px-0 md:px-6 mb-4">
                                <p
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-orange-600 rounded-lg hover:bg-orange-600 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    {{ \Carbon\Carbon::parse($ticket->event->event_date)->format('j F') }}</p>
                                {{-- <p class="text-2xl font-bold">{{ $ticket->event->price }}</p> --}}
                            </div>
                        </div>
                    </a>
                    <!-- end card -->
                @endforeach
            </div>
        @endif
    </div>
    <!-- end card -->
@endsection
