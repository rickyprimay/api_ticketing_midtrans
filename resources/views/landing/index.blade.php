@extends('auth.layouts.app')

@section('content')
    @if (auth()->check())
        <p>Welcome, {{ auth()->user()->name }}</p>
        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="btn bg-red-400">Logout</button>
        </form>

        <h2 class="mt-4 text-2xl font-bold">Events List</h2>
        <table class="table-auto mt-2">
            <thead>
                <tr>
                    <th class="px-4 py-2">Event Name</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Price</th>
                    <th class="px-4 py-2">Location</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Pesan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td class="border px-4 py-2">{{ $event->event_name }}</td>
                        <td class="border px-4 py-2">{{ $event->event_description }}</td>
                        <td class="border px-4 py-2">{{ $event->price }}</td>
                        <td class="border px-4 py-2">{{ $event->event_location }}</td>
                        <td class="border px-4 py-2">{{ $event->event_date }}</td>
                        <td class="border px-4 py-2"><a href="" class="btn bg-red-400">Pesan</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <a href="{{ route('auth.login') }}" class="btn bg-blue-500 rounded">Login</a>
        <a href="{{ route('auth.register') }}" class="btn bg-blue-600 rounded">Register</a>
    @endif
@endsection
