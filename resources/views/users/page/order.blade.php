@extends('users.layouts.app')

@section('content')
<form class="max-w-md mx-auto" method="POST" action="{{ route('create-invoice') }}">
    @csrf
    <div class="relative z-0 w-full mt-5 mb-5 group">
        <input type="number" name="qty" id="qty" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <input type="hidden" name="price" id="price" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{$price}}" required />
        <label for="floating_qty" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Qty</label>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <h2>Price</h2>
        <p>Rp. {{ number_format($price, 0, ',', '.') }}</p>
    </div>
    <div class="relative z-0 w-full mb-5 group">
        <h2>Total Price</h2>
        <p id="total-price">Rp. {{ number_format($price, 0, ',', '.') }}</p>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>

<script>
    document.getElementById('qty').addEventListener('input', function() {
        let qty = this.value;
        let price = {{ $price }};
        let totalPrice = qty * price;
        document.getElementById('total-price').innerText = 'Rp. ' + totalPrice.toLocaleString();
    });
</script>
@endsection
