@extends('landing.layouts.app')

@section('content')
    <!-- content -->
    <section class="container mx-auto px-4 py-28">
        <h1 class="text-4xl font-bold mb-6 md:text-left text-center">Transaction History</h1>

        @if ($orders->isEmpty())
            <h1 class="text-xl font-semibold text-center mt-[200px] mb-[200px]">Oops, there are no transaction records.</h1>
        @else
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach ($orders as $order)
                    <!-- card -->
                    <div
                        class="flex flex-col items-center bg-white border border-black rounded-lg shadow md:flex-row md:max-w-2xl hover:bg-gray-100">
                        <div class="flex flex-col justify-between p-4 leading-normal w-full">
                            <h5 class="text-2xl font-bold tracking-tight text-black mb-4">Transaction History</h5>
                            <h5 class="text-xl tracking-tight text-black mb-4">{{ $order->no_transaction }}</h5>
                            @if ($order->status == 'pending')
                                <button onclick="window.location.href='{{ $order->invoice_url }}';"
                                    class="bg-amber-700 text-white px-4 py-2 rounded inline-block">
                                    Checkout
                                </button>
                            @elseif ($order->status == 'Success')
                                <button data-modal-target="small-modal" data-modal-toggle="small-modal"
                                    class="bg-[#454545] text-white px-4 py-2 rounded inline-block">
                                    Invoice
                                </button>
                            @endif
                            <div class="flex flex-col pt-2 md:flex-row justify-between items-start md:items-center w-full">
                                <div class="text-black mb-2 md:mb-0">
                                    <p class="font-bold">Description</p>
                                    <p>{{ $order->event->event_name }}</p>
                                </div>
                                <div class="text-black mb-2 md:mb-0">
                                    <p class="font-bold">Amount</p>
                                    <p>{{ $order->qty }}</p>
                                </div>
                                <div class="text-black mb-2 md:mb-0">
                                    <p class="font-bold">Status</p>
                                    <p>{{ $order->status }}</p>
                                </div>
                                <div class="text-black mb-2 md:mb-0">
                                    <p class="font-bold">Category</p>
                                    <ul>
                                        @foreach ($order->event->tickets as $ticket)
                                            @if ($ticket->price == $order->price)
                                                <li>{{ $ticket->ticket_type }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="text-black mb-2 md:mb-0">
                                    <p class="font-bold">Total amount</p>
                                    <p>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                    <!-- Small Modal -->
                    <div id="small-modal" tabindex="-1"
                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-screen max-h-full">
                        <div class="relative w-full max-w-md max-h-full mx-auto">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow ">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t ">
                                    <h3 class="text-xl font-medium text-gray-900 ">
                                        {{ $order->no_transaction }}
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                        data-modal-hide="small-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="h-[600px] flex items-center justify-center p-8 md:p-5 space-y-4">
                                    <iframe src="{{ $order->invoice_url }}" class="w-full h-full"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
    <!-- end content -->
@endsection
