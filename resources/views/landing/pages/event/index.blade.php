@extends('landing.layouts.app')

@section('content')
<h1 class="text-3xl font-bold underline text-white bg-blue-500">
    List of Events
  </h1>
  <table class="table-auto">
    <thead>
      <tr>
        <th class="px-4 py-2">ID</th>
        <th class="px-4 py-2">Name</th>
        <th class="px-4 py-2">Description</th>
        <th class="px-4 py-2">Price</th>
        <th class="px-4 py-2">Location</th>
        <th class="px-4 py-2">Date</th>
        <th class="px-4 py-2">Event picture</th>
        <th class="px-4 py-2">details</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      @foreach ($events as $event)
        <td class="border px-4 py-2"><span class="text-blue-500">{{ $event->event_id }}</span></td>
        <td class="border px-4 py-2"><span class="text-blue-500">{{ $event->event_name }}</span></td>
        <td class="border px-4 py-2"><span class="text-blue-500">{{ $event->event_description }}</span></td>
        <td class="border px-4 py-2"><span class="text-blue-500">{{ $event->price }}</span></td>
        <td class="border px-4 py-2"><span class="text-blue-500">{{ $event->event_location }}</span></td>
        <td class="border px-4 py-2"><span class="text-blue-500">{{ $event->event_date }}</span></td>
        <td class="border px-4 py-2">
          @if ($event->event_picture)
          <img src="{{ asset('storage/' . $event->event_picture) }}" alt="Event Picture" style="max-width: 100px;">
          @else
          <span class="text-blue-500">No Picture Available</span>
          @endif
          <td class="border px-4 py-2">
            <a href="{{ route('event_details', ['event_id' => $event->event_id]) }}" class="text-blue-500">Detail</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection