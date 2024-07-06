<!-- resources/views/admin/index.blade.php -->
@extends('superadmin.layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<!-- content -->
<div class="">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-24 border border-black">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 table-border">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3">No. </th>
            <th scope="col" class="px-6 py-3">Nama User</th>
            <th scope="col" class="px-6 py-3">Email</th>
            <th scope="col" class="px-6 py-3">No. Telp</th>
            <th scope="col" class="px-6 py-3">Gender</th>
            <th scope="col" class="px-6 py-3">Birth Date</th>
            {{-- <th scope="col" class="px-6 py-3">Action</th> --}}
          </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
          <tr class="odd:bg-white even:bg-gray-50 border-b">
              <td class="px-6 py-4">{{ $index+1 }}</td>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $user->name }}</th>
            <td class="px-6 py-4">{{ $user->email }}</td>
            <td class="px-6 py-4">{{ $user->phone_number }}</td>
            <td class="px-6 py-4">{{ $user->gender }}</td>
            <td class="px-6 py-4">{{ $user->birth_date }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
