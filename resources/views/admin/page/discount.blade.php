@extends('admin.layouts.app')

@section('title', 'Diskon')

@section('content')

<div class="">
    <button data-modal-target="create-modal" data-modal-toggle="create-modal" class="bg-green-500 text-white py-2 px-4 rounded-lg mb-4 inline-flex items-center">
        <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M12 4v16m-8-8h16"></path>
        </svg>
        Buat Diskon
    </button>
    @if($discounts->isEmpty())
        <h1 class="text-center text-xl mt-8">Oops, tidak ada data Diskon Anda.</h1>
    @else
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8 border border-black">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 table-border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama Event</th>
                    <th scope="col" class="px-6 py-3">Tipe Tiket</th>
                    <th scope="col" class="px-6 py-3">Diskon</th>
                    <th scope="col" class="px-6 py-3">Code</th>
                    <th scope="col" class="px-6 py-3">Terpakai</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discounts as $discount)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $discount->event->event_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $discount->ticket->ticket_type }}</td>
                        <td class="px-6 py-4">Rp&nbsp;{{ number_format($discount->total_discount, 0, ',', '.') }}</td>                                          
                        <td class="px-6 py-4 whitespace-nowrap">{{ $discount->code }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $discount->used }}</td>
                        <td class="px-6 py-4">
                            <button data-modal-target="edit-modal-{{ $discount->id }}" data-modal-toggle="edit-modal-{{ $discount->id }}" type="button" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Edit</button>
                            <button data-modal-target="delete-modal-{{ $discount->event_id }}" data-modal-toggle="delete-modal-{{ $discount->event_id }}" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <div id="create-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Buat Diskon
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="create-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <form action="{{route('admin.discount.store')}}" method="POST" class="p-4 md:p-5">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="event_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event</label>
                                    <select name="event_id" id="event_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <option value="">Pilih Event</option>
                                        @foreach($events as $event)
                                            <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                                        @endforeach
                                    </select>
                                    
                                    <label for="ticket_id" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Ticket</label>
                                    <select name="ticket_id" id="ticket_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" disabled>
                                        <option value="">Pilih Event terlebih dahulu</option>
                                    </select>
                                    
                                    <label for="discount"
                                        class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Diskon</label>
                                    <input type="number" name="total_discount" id="discount"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Diskon" required="">
                                    <label for="code"
                                        class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Code</label>
                                    <input type="text" name="code" id="code"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Code" required="">
                                    <label for="used"
                                        class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                                    <input type="number" name="used" id="used"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Stock" required="">
                                </div>
                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Buat Diskon
                            </button>
                        </form>
                    </div>
                </div>
            </div>
</div>

<script>
    document.getElementById('event_id').addEventListener('change', function() {
        const eventId = this.value;
        const ticketSelect = document.getElementById('ticket_id');

        if(eventId) {
            fetch(`/admin/tickets/${eventId}`)
                .then(response => response.json())
                .then(data => {
                    ticketSelect.innerHTML = '<option value="">Pilih Tiket</option>';
                    data.forEach(ticket => {
                        ticketSelect.innerHTML += `<option value="${ticket.ticket_id}">${ticket.ticket_type}</option>`;
                    });
                    ticketSelect.disabled = false;
                });
        } else {
            ticketSelect.innerHTML = '<option value="">Pilih Event terlebih dahulu</option>';
            ticketSelect.disabled = true;
        }
    });
</script>

@endsection
