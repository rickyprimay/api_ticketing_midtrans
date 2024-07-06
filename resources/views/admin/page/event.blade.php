@extends('admin.layouts.app')

@section('title', 'Event')

@section('content')
<div class="">
    <a href="{{ route('event.create') }}" class="bg-green-500 text-white py-2 px-4 rounded-lg mb-4 inline-flex items-center">
        <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 4v16m-8-8h16"></path></svg>
        Buat Event
    </a>
    @if($events->isEmpty())
        <h1 class="text-center text-xl mt-8">Oops, tidak ada data pembeli Anda.</h1>
    @else
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8 border border-black">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 table-border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama Event</th>
                    <th scope="col" class="px-6 py-3">Deskripsi Event</th>
                    <th scope="col" class="px-6 py-3">Harga</th>
                    <th scope="col" class="px-6 py-3">Lokasi</th>
                    <th scope="col" class="px-6 py-3" style="width: 200px;">Profil Event</th>
                    <th scope="col" class="px-6 py-3">Tanggal Event</th>
                    <th scope="col" class="px-6 py-3">Event Mulai</th>
                    <th scope="col" class="px-6 py-3">Event Selesai</th>
                    <th scope="col" class="px-6 py-3">Event Status</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $event->event_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ Str::limit($event->event_description, 50) }}
                        </td>
                        <td class="px-6 py-4">Rp&nbsp;{{ number_format($event->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($event->event_location, 20) }}</td>
                        <td class="px-6 py-4 flex justify-center items-center">
                            <img src="{{ asset('storage/' . $event->event_picture) }}" alt="Event Picture" style="min-width: 150px; max-width: 200px; height: auto;">
                        </td>                                              
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('j F Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($event->event_start)->translatedFormat('j F Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($event->event_ended)->translatedFormat('j F Y') }}</td>
                        <td class="px-6 py-4">
                            @if ($event->event_status == 0)
                                Menunggu Verifikasi Admin
                            @elseif ($event->event_status == 1)
                                Terverifikasi
                            @elseif ($event->event_status == 2)
                                Dibatalkan
                            @elseif ($event->event_status == 3)
                                Selesai
                            @else
                                Tidak Diketahui
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <button data-modal-target="edit-modal-{{ $event->event_id }}" data-modal-toggle="edit-modal-{{ $event->event_id }}" type="button" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Edit</button>
                            <button data-modal-target="delete-modal-{{ $event->event_id }}" data-modal-toggle="delete-modal-{{ $event->event_id }}" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @foreach ($events as $event)
        <!-- Edit modal -->
        <div id="edit-modal-{{ $event->event_id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Edit Event
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="edit-modal-{{ $event->event_id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form action="{{ route('admin.event.update', $event->event_id) }}" method="POST" class="p-4 md:p-5">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="event_name" class="block mb-2 text-sm font-medium text-gray-900">Nama Event</label>
                                <input type="text" name="event_name" id="event_name" value="{{ $event->event_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                            </div>
                            <div class="col-span-2">
                                <label for="event_description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Event</label>
                                <textarea name="event_description" id="event_description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ $event->event_description }}</textarea>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Harga</label>
                                <input type="number" name="price" id="price" value="{{ $event->price }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="event_location" class="block mb-2 text-sm font-medium text-gray-900">Lokasi</label>
                                <input type="text" name="event_location" id="event_location" value="{{ $event->event_location }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="event_date" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Event</label>
                                <input type="date" name="event_date" id="event_date" value="{{ $event->event_date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="event_start" class="block mb-2 text-sm font-medium text-gray-900">Mulai Event</label>
                                <input type="date" name="event_start" id="event_start" value="{{ $event->event_start }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="event_ended" class="block mb-2 text-sm font-medium text-gray-900">Berakhir Event</label>
                                <input type="date" name="event_ended" id="event_ended" value="{{ $event->event_ended }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="event_status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                <select name="event_status" id="event_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" required>
                                    <option value="0" {{ $event->event_status == 0 ? 'selected' : '' }} disabled>Menunggu Verifikasi Admin</option>
                                    <option value="1" {{ $event->event_status == 1 ? 'selected' : '' }} disabled>Terverifikasi</option>
                                    <option value="2" {{ $event->event_status == 2 ? 'selected' : '' }}>Dibatalkan</option>
                                    <option value="3" {{ $event->event_status == 3 ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>                                                       
                        </div>
                        
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Delete modal -->
        <div id="delete-modal-{{ $event->event_id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Delete Event
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="delete-modal-{{ $event->event_id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <form id="delete-form-{{ $event->event_id }}" action="{{ route('admin.event.destroy', $event->event_id) }}" method="POST" class="p-4 md:p-5">
                        @csrf
                        @method('DELETE')
                        <p>Apakah anda yakin untuk menghapus event ini?</p>
                        <div class="flex justify-end space-x-2">
                            <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10" data-modal-toggle="delete-modal-{{ $event->event_id }}">Cancel</button>
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

<!-- Include your modal toggle script -->
<script>
document.querySelectorAll('[data-modal-toggle]').forEach(function (modalToggle) {
    modalToggle.addEventListener('click', function () {
        const targetModal = document.getElementById(modalToggle.getAttribute('data-modal-target'));
        targetModal.classList.toggle('hidden');
    });
});
</script>
@endsection
