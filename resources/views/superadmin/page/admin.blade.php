@extends('superadmin.layouts.app')

@section('title', 'Super Admin Dashboard')

@section('content')
<!-- content -->
<div class="">
    <button data-modal-target="create-modal" data-modal-toggle="create-modal"
            class="bg-green-500 text-white py-2 px-4 rounded-lg mb-4 inline-flex items-center">
            <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M12 4v16m-8-8h16"></path>
            </svg>
            Tambahkan Admin
    </button>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 border border-black">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 table-border">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3">No. </th>
            <th scope="col" class="px-6 py-3">Nama Admin</th>
            <th scope="col" class="px-6 py-3">Email</th>
            {{-- <th scope="col" class="px-6 py-3">Action</th> --}}
          </tr>
        </thead>
        <tbody>
            @foreach($admins as $index => $admin)
          <tr class="odd:bg-white even:bg-gray-50 border-b">
              <td class="px-6 py-4">{{ $index+1 }}</td>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $admin->name }}</th>
            <td class="px-6 py-4">{{ $admin->email }}</td>
            {{-- <td class="px-6 py-4">
                <button data-modal-target="delete-modal-{{ $admin->users_id }}" data-modal-toggle="delete-modal-{{ $admin->users_id }}" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Delete</button>
            </td> --}}
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- Main modal -->
      <div id="create-modal" tabindex="-1" aria-hidden="true"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-md max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                      Tambahkan Admin
                  </h3>
                  <button type="button"
                      class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                      data-modal-toggle="create-modal">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <form action="{{route('superadmin.admin.store')}}" method="POST" class="p-4 md:p-5">
                  @csrf
                  <div class="grid gap-4 mb-4 grid-cols-2">
                      <div class="col-span-2">
                          <label for="name"
                              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Admin</label>
                          <input type="text" name="name" id="name"
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                              placeholder="Nama Admin" required>
                      </div>
                      <div class="col-span-2">
                          <label for="email"
                              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email Admin</label>
                              <input type="email" name="email" id="email"
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                              placeholder="Email Admin" required>
                      </div>
                      <div class="col-span-2">
                          <label for="password"
                              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password Admin</label>
                              <input type="password" name="password" id="password"
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                              placeholder="*********" required>
                      </div>
                      
                  </div>
                  <button type="submit"
                      class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                      <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                          xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd"
                              d="M10 3a1 1 0 00-.707.293l-6 6a1 1 0 000 1.414l6 6a1 1 0 001.414-1.414L5.414 11H15a1 1 0 100-2H5.414l4.293-4.293A1 1 0 0010 3z"
                              clip-rule="evenodd"></path>
                      </svg>
                      Tambah Admin
                  </button>
              </form>
          </div>
      </div>
  </div>
  <!-- End of Main Modal -->
    </div>
  </div>
  
  <script>
    document.querySelectorAll('[data-modal-toggle]').forEach(function (modalToggle) {
        modalToggle.addEventListener('click', function () {
            const targetModal = document.getElementById(modalToggle.getAttribute('data-modal-target'));
            targetModal.classList.toggle('hidden');
            targetModal.classList.toggle('flex');
        });
    });
  </script>
@endsection
