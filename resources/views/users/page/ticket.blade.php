@extends('users.layouts.app')

@section('content')
    <h2 class="mt-4 text-2xl font-bold">Tickets List dari event {{ $event->event_name }}</h2>
    <table class="table-auto mt-2">
        <thead>
            <tr>
                <th class="px-4 py-2">Ticket Type</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Pesan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td class="border px-4 py-2">{{ $ticket->ticket_type }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($ticket->price, 0, ',', '.') }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('order', ['event_id' => $event->event_id, 'price' => $ticket->price]) }}" class="btn bg-red-400">Beli</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
