<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Illuminate\Support\Str;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\InvoiceItem;

class OrdersController extends Controller
{
    public function __construct()
    {
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));
    }
    public function order($event_id, $price)
    {
        return view('users.page.order', ['price' => $price]);
    }
    public function createInvoice(Request $request)
    {

        try {
            
            $qty = $request->input('qty');
            $price = $request->input('price');
            $totalAmount = $qty * $price;
            
            $no_transaction = 'Inv-' . (string) Str::uuid();
            $order = new Order;
            $order->no_transaction = $no_transaction;
            $order->external_id = $no_transaction;
            $order->name_buyer = Auth::user()->name;
            $order->email_buyer = Auth::user()->email;
            $order->qty = $qty;
            $order->price = $price;
            $order->total_amount = $totalAmount;

            $items = new InvoiceItem([
                'name' => Auth::user()->name,
                'price' => $price,
                'quantity' => $request->input('qty')
            ]);

            $createInvoice = new CreateInvoiceRequest([
                'external_id' => $no_transaction,
                'amount' => $totalAmount,
                'invoice_duration' => 172800,
                'items' => [$items]
            ]);
            
            $apiInstance = new InvoiceApi();
            $generateInvoice = $apiInstance->createInvoice($createInvoice);
            $order->invoice_url = $generateInvoice['invoice_url'];
            $order->save();

            return dd($order);

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
