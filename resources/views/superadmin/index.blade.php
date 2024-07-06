<!-- resources/views/admin/index.blade.php -->
@extends('superadmin.layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class=" mt-24 px-8 md:px-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
      <div class="bg-orange-500 text-white p-4 rounded-lg">
        <div class="text-2xl font-bold">2478</div>
        <div class="text-lg">User</div>
      </div>
      <div class="bg-green-500 text-white p-4 rounded-lg">
        <div class="text-2xl font-bold">983</div>
        <div class="text-lg">Panitia</div>
      </div>
      <div class="bg-purple-500 text-white p-4 rounded-lg">
        <div class="text-2xl font-bold">1256</div>
        <div class="text-lg">Admin</div>
      </div>
      <div class="bg-blue-500 text-white p-4 rounded-lg">
        <div class="text-2xl font-bold">652</div>
        <div class="text-lg">Event</div>
      </div>
    </div>
  </div>
@endsection
