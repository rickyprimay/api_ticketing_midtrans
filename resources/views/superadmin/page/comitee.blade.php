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
            Tambahkan Panitia
    </button>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4 border border-black">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 table-border">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3">No. </th>
            <th scope="col" class="px-6 py-3">Nama Panitia</th>
            <th scope="col" class="px-6 py-3">Email</th>
            <th scope="col" class="px-6 py-3">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($committees as $index => $committee)
          <tr class="odd:bg-white even:bg-gray-50 border-b">
              <td class="px-6 py-4">{{ $index+1 }}</td>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $committee->name }}</th>
            <td class="px-6 py-4">{{ $committee->email }}</td>
            <td class="px-6 py-4">
                <button data-modal-target="delete-modal-{{ $committee->users_id }}" data-modal-toggle="delete-modal-{{ $committee->users_id }}" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Delete</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      
      <!-- Delete modal -->
      @foreach ($committees as $committee)
      <div id="delete-modal-{{ $committee->users_id }}" tabindex="-1" aria-hidden="true"
          class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative p-4 w-full max-w-md max-h-full">
              <!-- Modal content -->
              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                  <!-- Modal header -->
                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                          Hapus Panitia
                      </h3>
                      <button type="button"
                          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                          data-modal-toggle="delete-modal-{{ $committee->users_id }}">
                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                              viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                          </svg>
                          <span class="sr-only">Close modal</span>
                      </button>
                  </div>
                  <!-- Modal body -->
                  <form action="{{route('superadmin.committee.destroy', ['id' => $committee->users_id]) }}" method="POST"
                      class="p-4 md:p-5">
                      @csrf
                      @method('DELETE')
                      <p class="text-sm text-gray-700 dark:text-gray-300">
                          Apakah Anda yakin ingin menghapus panitia ini?
                      </p>
                      <!-- Modal footer -->
                      <div class="flex justify-end">
                          <button type="submit"
                              class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-600 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Hapus</button>
                          <button type="button"
                              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
                              data-modal-toggle="delete-modal-{{ $committee->users_id }}">Batal</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
      @endforeach
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
