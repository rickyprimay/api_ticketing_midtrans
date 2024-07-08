@extends('admin.layouts.app')

@section('title', 'Pembeli')

@section('content')
    <div class="container mx-auto mt-24">
        <form method="GET" action="{{ route('admin.buyer') }}" class="mb-4">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Mulai Tanggal</label>
                    <input type="date" id="start_date" name="start_date" class="form-input mt-1 block w-full" value="{{ request('start_date') }}">
                </div>
                <div class="relative">
                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Sampai Tanggal</label>
                    <input type="date" id="end_date" name="end_date" class="form-input mt-1 block w-full" value="{{ request('end_date') }}">
                </div>
                <div class="relative">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Status</label>
                    <select id="status" name="status" class="form-select mt-1 block w-full">
                        <option value="">Semua</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') == 'Success' ? 'selected' : '' }}>Success</option>
                        <option value="canceled" {{ request('status') == 'Failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <div class="relative">
                    <button type="submit" class="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Filter
                    </button>
                </div>
            </div>
        </form>
        
        @if ($orders->isEmpty())
            <h1 class="text-center text-xl mt-8">Oops, tidak ada data pembeli Anda.</h1>
        @else
        <div class="mt-4 mb-8">
            <a href="{{ route('admin.export') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Export to Excel</a>
        </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg border border-black">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-border">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">NO</th>
                            <th scope="col" class="px-6 py-3">Tiket acara yang Dibeli</th>
                            <th scope="col" class="px-6 py-3">Pemesanan pada</th>
                            <th scope="col" class="px-6 py-3">No Transaksi</th>
                            <th scope="col" class="px-6 py-3">Nama Pembeli</th>
                            <th scope="col" class="px-6 py-3">Email Pembeli</th>
                            <th scope="col" class="px-6 py-3">Gender</th>
                            <th scope="col" class="px-6 py-3">No HP</th>
                            <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                            <th scope="col" class="px-6 py-3">Jumlah Pembelian</th>
                            <th scope="col" class="px-6 py-3">Harga</th>
                            <th scope="col" class="px-6 py-3">Total Harga</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $order->event->event_name }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('l, d F Y') }}</td>
                                <td class="px-6 py-4">{{ $order->no_transaction }}</td>
                                <td class="px-6 py-4">{{ $order->first_name }} {{ $order->last_name }}</td>
                                <td class="px-6 py-4">{{ $order->email_buyer }}</td>
                                <td class="px-6 py-4">{{ $order->gender }}</td>
                                <td class="px-6 py-4">{{ $order->phone_number }}</td>
                                <td class="px-6 py-4">{{ $order->birth_date }}</td>
                                <td class="px-6 py-4">{{ $order->qty }}</td>
                                <td class="px-6 py-4">{{ $order->price }}</td>
                                <td class="px-6 py-4">{{ $order->total_amount }}</td>
                                <td class="px-6 py-4">{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
