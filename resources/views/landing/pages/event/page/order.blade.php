@extends('landing.layouts.app')

@section('content')
    <!-- hero -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex justify-center pt-3">
                <img src="{{ asset('storage/event_pictures/' . $event->event_picture) }}"
                    class="w-[800px] h-[400px] object-cover" alt="Event Image" />
            </div>
            <div class="bg-white p-6 rounded-lg border-2 border-black">
                <h2 class="text-2xl font-bold mb-4">{{ $event->event_name }}</h2>
                <div class="text-gray-700 mb-4">
                    <p>{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('j F Y') }} {{ $event->event_time }}</p>
                    <p>{{ $event->event_location }}</p>
                </div>
                <h3 class="text-xl font-semibold mt-8 mb-2">Mau beli berapa tiket?</h3>
                <form class="max-w-md" method="POST" action="{{ route('create-invoice') }}" target="_blank">
                    @csrf
                    <div class="relative z-0 w-full mt-5 mb-5 group">
                        <input type="number" name="qty" id="qty" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="1" required />
                        <input type="hidden" name="price" id="price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{ $price }}" required />
                        <input type="hidden" name="event_id" id="event_id" value="{{ $event_id }}" required />
                        <label for="floating_qty" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Qty</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <h2>Harga</h2>
                        <p>Rp. {{ number_format($price, 0, ',', '.') }}</p>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <h2>Total Harga</h2>
                        <p id="total-price">Rp. {{ number_format($price, 0, ',', '.') }}</p>
                    </div>
                    <button type="submit" class="bg-[#454545] text-white px-4 py-2 rounded">Bayar</button>
                </form>
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
    <script>
        document.getElementById('qty').addEventListener('input', function() {
        let qty = parseInt(this.value) || 0; 
        let price = {{ $price }};
        let totalPrice = qty * price;
        
        if (qty === 0) {
            totalPrice = 0;
        }

        document.getElementById('total-price').innerText = 'Rp. ' + totalPrice.toLocaleString();
    });
    </script>
@endsection
