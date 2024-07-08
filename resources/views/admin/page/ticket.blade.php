@extends('admin.layouts.app')

@section('title', 'Tiket')

@section('content')
    <div class="">
        @if($event->isEmpty())
        <div class="text-center text-xl mt-8">
            <p>Anda harus menambahkan event dulu.</p>
        </div>
        @else
        <button data-modal-target="create-modal" data-modal-toggle="create-modal"
            class="bg-green-500 text-white py-2 px-4 rounded-lg mb-4 inline-flex items-center">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M12 4v16m-8-8h16"></path>
            </svg>
            Buat Ticket
        </button>
        @endif
        <div class="flex justify-start mb-4">
            <input type="text" id="eventFilter" placeholder="Filter berdasarkan Nama Event"
                class="border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200 rounded-lg px-4 py-2">
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-black">
            <table id="ticketTable"
                class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-border">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">No.</th>
                        <th scope="col" class="px-6 py-3">Tipe Tiket</th>
                        <th scope="col" class="px-6 py-3">Event Asal Tiket</th>
                        <th scope="col" class="px-6 py-3">Harga Tiket</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($tickets->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center text-xl mt-8">Oops, tidak ada data ticket Anda.</td>
                        </tr>
                    @else
                    @foreach ($tickets as $index => $ticket)
                        <tr
                            class="{{ $index % 2 == 0 ? 'even:bg-gray-50 even:dark:bg-gray-800' : 'odd:bg-white odd:dark:bg-gray-900' }} border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $index + 1 }}</th>
                            <td class="px-6 py-4">{{ $ticket->ticket_type }}</td>
                            <td class="px-6 py-4">
                                {{ $ticket->event->event_name }}
                            </td>
                            <td class="px-6 py-4">Rp&nbsp;{{ number_format($ticket->price, 0, ',', '.') }}</td>

                            <td class="px-6 py-4">
                                <button data-modal-target="edit-modal-{{ $ticket->ticket_id }}"
                                    data-modal-toggle="edit-modal-{{ $ticket->ticket_id }}" type="button"
                                    class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Edit</button>
                                <button data-modal-target="popup-modal-{{ $ticket->ticket_id }}"
                                    data-modal-toggle="popup-modal-{{ $ticket->ticket_id }}" type="button"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Delete</button>
                            </td>

                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <!-- Main modal -->
            <div id="create-modal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Buat Ticket
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
                        <form action="{{route('admin.ticket.store')}}" method="POST" class="p-4 md:p-5">
                            @csrf
                            <div class="grid gap-4 mb-4 grid-cols-2">
                                <div class="col-span-2">
                                    <label for="ticket_type"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipe
                                        Tiket</label>
                                    <input type="text" name="ticket_type" id="ticket_type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Tipe tiket" required="">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="event_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Asal
                                        Ticket</label>
                                        <select name="event_id" id="event_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        required="">
                                        <option value="" selected>Pilih Event</option>
                                        @foreach ($event as $eventsa)
        <option value="{{ $eventsa->event_id }}">{{ $eventsa->event_name }}</option>
    @endforeach
                                    </select>
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <label for="price"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga
                                        Ticket</label>
                                    <input type="number" name="price" id="price"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="" required="">
                                </div>

                            </div>
                            <button type="submit"
                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 00-.707.293l-6 6a1 1 0 000 1.414l6 6a1 1 0 001.414-1.414L5.414 11H15a1 1 0 100-2H5.414l4.293-4.293A1 1 0 0010 3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Buat Ticket
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End of Main Modal -->
        </div>
    </div>
    <!-- Edit modal -->
@foreach ($tickets as $ticket)
<div id="edit-modal-{{ $ticket->ticket_id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Edit Event
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal-{{ $ticket->ticket_id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form action="{{ route('admin.ticket.update', $ticket->ticket_id) }}" method="POST" class="p-4 md:p-5">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="ticket_type" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Tipe Tiket</label>
                        <input type="text" name="ticket_type" id="ticket_type" value="{{ $ticket->ticket_type }}" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 dark:bg-gray-700 dark:text-white dark:border-gray-500 dark:focus:border-primary-500" required>
                    </div>
                    <div>
                        <label for="event_id" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Event Asal Tiket</label>
                        <select name="event_id" id="event_id" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 dark:bg-gray-700 dark:text-white dark:border-gray-500 dark:focus:border-primary-500" required>
                            @foreach ($event as $eventsa)
        <option value="{{ $eventsa->event_id }}">{{ $eventsa->event_name }}</option>
    @endforeach
                        </select>
                        
                    </div>
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">Harga Tiket</label>
                        <input type="text" name="price" id="price" value="{{ $ticket->price }}" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-primary-600 dark:bg-gray-700 dark:text-white dark:border-gray-500 dark:focus:border-primary-500" required>
                    </div>
                </div>
                
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</button>
            </form>
        </div>
    </div>
</div>
@endforeach

        <!-- Delete modal -->
@foreach ($tickets as $ticket)
<div id="popup-modal-{{ $ticket->ticket_id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Hapus Tiket
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="popup-modal-{{ $ticket->ticket_id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{route('admin.ticket.destroy', ['id' => $ticket->ticket_id]) }}" method="POST"
                class="p-4 md:p-5">
                @csrf
                @method('DELETE')
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Apakah Anda yakin ingin menghapus tiket ini?
                </p>
                <!-- Modal footer -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-600 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Hapus</button>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
                        data-modal-toggle="popup-modal-{{ $ticket->ticket_id }}">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
</div>

    <script>
document.querySelectorAll('[data-modal-toggle]').forEach(function (modalToggle) {
    modalToggle.addEventListener('click', function () {
        const targetModal = document.getElementById(modalToggle.getAttribute('data-modal-target'));
        targetModal.classList.toggle('hidden');
    });
});
        const eventFilterInput = document.getElementById('eventFilter');
        const ticketRows = document.querySelectorAll('#ticketTable tbody tr');

        eventFilterInput.addEventListener('input', function() {
            const filterValue = eventFilterInput.value.toLowerCase().trim();

            ticketRows.forEach(row => {
                const eventName = row.querySelector('td:nth-child(3)').textContent.toLowerCase();

                if (eventName.includes(filterValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
