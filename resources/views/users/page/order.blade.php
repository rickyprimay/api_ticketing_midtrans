@extends('users.layouts.app')

@section('content')
    <form class="max-w-md mx-auto" method="POST" action="{{ route('create-invoice') }}">
        @csrf
        <div class="relative z-0 w-full mt-5 mb-5 group">
            <input type="number" name="qty" id="qty" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
            <input type="hidden" name="price" id="price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{ $price }}" required />
            <input type="hidden" name="event_id" id="event_id" value="{{ $event_id }}" required />
            <label for="floating_qty" class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Qty</label>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <h2>Price</h2>
            <p>Rp. {{ number_format($price, 0, ',', '.') }}</p>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <h2>Total Price</h2>
            <p id="total-price">Rp. {{ number_format($price, 0, ',', '.') }}</p>
        </div>
        <button type="submit" class="text-white focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Submit</button>
    </form>

    <h2 class="mt-4 text-2xl font-bold mx-4">Order List</h2>
    <table class="table-auto mt-2 mx-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Name Buyer</th>
                <th class="px-4 py-2">Email Buyer</th>
                <th class="px-4 py-2">Qty</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Total Amount</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td class="border px-4 py-2">{{ $order->name_buyer }}</td>
                    <td class="border px-4 py-2">{{ $order->email_buyer }}</td>
                    <td class="border px-4 py-2">{{ $order->qty }}</td>
                    <td class="border px-4 py-2">{{ $order->status }}</td>
                    <td class="border px-4 py-2">Rp. {{ number_format($order->price, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">Rp. {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2"><a target="_blank" href="{{ $order->invoice_url }}" class="btn bg-red-400">pay</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.getElementById('qty').addEventListener('input', function() {
            let qty = this.value;
            let price = {{ $price }};
            let totalPrice = qty * price;
            document.getElementById('total-price').innerText = 'Rp. ' + totalPrice.toLocaleString();
        });
    </script>
@endsection
