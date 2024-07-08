@extends('superadmin.layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="">
    
    @if($events->isEmpty())
        <h1 class="text-center text-xl mt-8">Oops, tidak ada data Event Anda.</h1>
    @else
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8 border border-black">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 table-border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">No. </th>
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
                @foreach ($events as $index => $event)
                    <tr class="odd:bg-white even:bg-gray-50 border-b">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $index+1 }}</td>
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
                            @if ($event->event_status == 1)
                                <form action="{{ route('superadmin.event.verify', $event->event_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Verifikasi</button>
                                </form>
                            @elseif ($event->event_status == 2)
                                Sudah Terverifikasi
                            @elseif ($event->event_status == 3)
                                Dibatalkan
                            @elseif ($event->event_status == 4)
                                Selesai
                            @else
                                Tidak Diketahui
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection
