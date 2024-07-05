<!-- resources/views/admin/index.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Ticket')

@section('content')
<div class="">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-24 border border-black">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-border">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">No.</th>
            <th scope="col" class="px-6 py-3">Ticket Type</th>
            <th scope="col" class="px-6 py-3">Ticket Dari event</th>
            <th scope="col" class="px-6 py-3">Harga Ticket</th>
          </tr>
        </thead>
        <tbody>
          <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple MacBook Pro 17"</th>
            <td class="px-6 py-4">Silver</td>
            <td class="px-6 py-4">
              <img src="/image/carousels1.svg" class="w-[200px]" alt="" />
            </td>
            <td class="px-6 py-4">$2999</td>
            <td class="px-6 py-4">
              <a href="editevent.html" class="text-blue-600 hover:underline"
                ><button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Edit</button></a
              >
              <a href="#" class="text-blue-600 hover:underline">
                <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Delete</button>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@endsection
