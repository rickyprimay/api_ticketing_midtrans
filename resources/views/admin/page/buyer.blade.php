@extends('admin.layouts.app')

@section('title', 'Pembeli')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
    @foreach($events as $event)
        <?php
            $bgColors = ['bg-green-500', 'bg-blue-500', 'bg-yellow-500', 'bg-red-500', 'bg-purple-500'];
            $randomColor = $bgColors[array_rand($bgColors)];
        ?>
        <a href="{{ route('admin.buyerDetail', ['event_id' => $event->event_id]) }}" class="{{ $randomColor }} text-white p-4 rounded-lg">
            <div class="text-xl font-bold">Nama Event:</div>
            <div class="text-2xl font-bold">{{ $event->event_name }}</div>
        </a>
    @endforeach
</div>
@endsection
