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
                    <p>{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('j F Y') }} {{ $event->event_time }}</p>
                    <p>{{ $event->event_location }}</p>
                </div>
                <h3 class="text-xl font-semibold mt-8 mb-2">Mau beli berapa tiket?</h3>
                <form class="max-w-md" method="POST" action="{{ route('create-invoice') }}">
                    @csrf
                    <div class="relative z-0 w-full mt-5 mb-5 group">
                        <input type="number" name="qty" id="qty"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " value="1" required />
                        <input type="hidden" name="price" id="price"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            value="{{ $price }}" required />
                        <input type="hidden" name="event_id" id="event_id" value="{{ $event_id }}" required />
                        <label for="floating_qty"
                            class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Qty</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <h2>Harga</h2>
                        <p>Rp. {{ number_format($price, 0, ',', '.') }}</p>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <h2>Total Harga</h2>
                        <p id="total-price">Rp. {{ number_format($price, 0, ',', '.') }}</p>
                    </div>
                    <button type="button" id="lanjut-btn" class="bg-[#454545] text-white px-4 py-2 rounded">Lanjut</button>
            </div>
        </div>
        <div id="form_personal" class="grid mt-4" style="display: none;">
            <div class="bg-white p-6 rounded-lg border-2 border-black">
                <h2 class="text-2xl font-bold mb-4">Informasi Personal</h2>
                <div class="mb-4">
                    <input type="checkbox" id="use_auth_data" name="use_auth_data">
                    <label for="use_auth_data">Apakah Anda ingin mengisi data sesuai dengan data yang login?</label>
                </div>
                <div class="relative z-0 w-full mt-5 mb-5 group">
                    <input type="text" name="name" id="name"
                        class="block py-2.5 px-0 w-[1000px] text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value="" required />
                    <label for="floating_first_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Full
                        Name</label>
                </div>
                <div class="relative z-0 w-full mt-5 mb-5 group">
                    <input type="text" name="first_name" id="first_name"
                        class="block py-2.5 px-0 w-[1000px] text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value="" required />
                    <label for="floating_first_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First
                        Name</label>
                </div>
                <div class="relative z-0 w-full mt-5 mb-5 group">
                    <input type="text" name="last_name" id="last_name"
                        class="block py-2.5 px-0 w-[1000px] text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value="" required />
                    <label for="floating_last_name"
                        class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last
                        Name</label>
                </div>
                <div class="relative z-0 w-full mt-5 mb-5 group">
                    <input type="email" name="email" id="email"
                        class="block py-2.5 px-0 w-[1000px] text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value="" required />
                    <label for="floating_users_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                </div>
                <div class="relative z-0 w-full mt-5 mb-5 group">
                    <input type="number" name="phone_number" id="phone_number"
                        class="block py-2.5 px-0 w-[1000px] text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " value="" required />
                    <label for="floating_users_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone Number</label>
                </div>
                <div class="relative z-0 w-full mt-5 mb-5 group">
                    <div class="mt-2">
                        <label for="datepicker-format" class="block text-gray-700">Birth Date</label>
                        <div
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                            <input name="birth_date" id="datepicker-format" datepicker datepicker-format="yyyy-mm-dd" type="text"
                                class="border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="yyyy-mm-dd" />
                        </div>
                    </div>
                </div>
                <div class="relative z-0 w-full mt-5 mb-5 group">
                    <label class="block text-gray-700">Gender</label>
                    <div class="mt-1 flex space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" class="form-radio" value="male" />
                            <span class="ml-2">Male</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="gender" class="form-radio" value="female" />
                            <span class="ml-2">Female</span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="bg-[#454545] text-white px-4 py-2 rounded">Checkout</button>
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

        document.getElementById('lanjut-btn').addEventListener('click', function() {
            let formPersonal = document.getElementById('form_personal');
            formPersonal.style.display = 'block';
            formPersonal.classList.add('show-with-animation');
        });

        document.getElementById('use_auth_data').addEventListener('change', function() {
            if (this.checked) {
                let user = @json(auth()->user());
                document.getElementById('name').value = user.name;
                document.getElementById('email').value = user.email;
                document.getElementById('phone_number').value = user.phone_number;
                document.getElementById('datepicker-format').value = user.birth_date;
                if (user.gender === 'male') {
                    document.querySelector('input[name="gender"][value="male"]').checked = true;
                } else {
                    document.querySelector('input[name="gender"][value="female"]').checked = true;
                }
            } else {
                document.getElementById('name').value = '';
                document.getElementById('email').value = '';
                document.getElementById('phone_number').value = '';
                document.getElementById('datepicker-format').value = '';
                document.querySelectorAll('input[name="gender"]').forEach(input => input.checked = false);
            }
        });
    </script>
@endsection
