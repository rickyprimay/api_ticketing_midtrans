<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class OrdersExport implements FromCollection, WithHeadings
{
    protected $orders;

    public function __construct(Collection $orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders->map(function ($order) {
            return [
                'NO' => $order->id, // Misalnya menggunakan $order->id sebagai nomor urut
                'Tiket acara yang Dibeli' => $order->event->event_name,
                'Pemesanan pada' => $order->created_at->format('l, d F Y'), // Format sesuai keinginan
                'No Transaksi' => $order->no_transaction,
                'Nama Pembeli' => $order->first_name . ' ' . $order->last_name,
                'Email Pembeli' => $order->email_buyer,
                'Gender' => $order->gender,
                'No HP' => $order->phone_number,
                'Tanggal Lahir' => $order->birth_date,
                'Jumlah Pembelian' => $order->qty,
                'Harga' => $order->price,
                'Total Harga' => $order->total_amount,
                'Status' => $order->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NO',
            'Tiket acara yang Dibeli',
            'Pemesanan pada',
            'No Transaksi',
            'Nama Pembeli',
            'Email Pembeli',
            'Gender',
            'No HP',
            'Tanggal Lahir',
            'Jumlah Pembelian',
            'Harga',
            'Total Harga',
            'Status',
            'ID',
        ];
    }
}
