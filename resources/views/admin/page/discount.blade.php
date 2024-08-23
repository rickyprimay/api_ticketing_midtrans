@extends('admin.layouts.app')

@section('title', 'Diskon')

@section('content')

<div class="">
    <a href="{{ route('event.create') }}" class="bg-green-500 text-white py-2 px-4 rounded-lg mb-4 inline-flex items-center">
        <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 4v16m-8-8h16"></path></svg>
        Buat Diskon
    </a> 
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
                            {{-- <button data-modal-target="delete-modal-{{ $event->event_id }}" data-modal-toggle="delete-modal-{{ $event->event_id }}" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Delete</button> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
