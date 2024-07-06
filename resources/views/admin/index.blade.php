<!-- resources/views/admin/index.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
    <div class="bg-orange-500 text-white p-4 rounded-lg">
      <div class="text-2xl font-bold">{{$totalTickets}}</div>
      <div class="text-lg">Ticket Anda</div>
    </div>
    <div class="bg-green-500 text-white p-4 rounded-lg">
      <div class="text-2xl font-bold">{{$totalEventsa}}</div>
      <div class="text-lg">Event Anda</div>
    </div>
    <div class="bg-blue-500 text-white p-4 rounded-lg">
      <div class="text-2xl font-bold">{{$totalOrders}}</div>
      <div class="text-lg">Pembeli Anda</div>
    </div>
    <div class="bg-purple-500 text-white p-4 rounded-lg">
      <div class="text-2xl font-bold">{{$totalTalents}}</div>
      <div class="text-lg">Talent Anda</div>
    </div>
  </div>
@endsection
