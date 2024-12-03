<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getSnapToken($id)
{
    // Ambil detail transaksi berdasarkan ID
    $transaksi = Transaksi::find($id);

    if (!$transaksi) {
        return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
    }

    // Detail transaksi untuk Midtrans
    $transactionDetails = [
        'order_id' => 'ORDER-' . $transaksi->id_transaksi,
        'gross_amount' => $transaksi->pesanan->total_pembayaran, // Total pembayaran
    ];

    $customerDetails = [
        'first_name' => $transaksi->pesanan->nama_pemesan,
        'email' => $transaksi->pesanan->email_pemesan ?? 'email@default.com',
    ];

    $snapParams = [
        'transaction_details' => $transactionDetails,
        'customer_details' => $customerDetails,
    ];

    try {
        $snapToken = \Midtrans\Snap::getSnapToken($snapParams);

        return response()->json(['snapToken' => $snapToken]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
