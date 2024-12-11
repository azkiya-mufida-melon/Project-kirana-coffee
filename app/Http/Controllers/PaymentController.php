<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Transaksi;
use Midtrans\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $transaksiId = $request->id_transaksi;
        
        // Proses pembayaran menggunakan Midtrans
        try {
            // Lakukan logika untuk memproses pembayaran, misalnya dengan Midtrans API
            $transaksi = Transaksi::find($transaksiId);
            
            // Misalnya, ambil virtual account number jika berhasil
            if ($transaksi) {
                return response()->json([
                    'va_numbers' => [
                        ['va_number' => '1234567890'] // Virtual account number yang didapat dari Midtrans
                    ]
                ]);
            } else {
                return response()->json(['error' => 'Transaksi tidak ditemukan'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        $notification = $request->all();

        if ($notification['status_transaksi'] == 'settlement') {
            $transaksi = Transaksi::where('id_transaksi', $notification['id_pesanan'])->first();
            $transaksi->status_transaksi = 'bayar'; // Update status transaksi
            $transaksi->save();
        }

        return response()->json(['message' => 'Notification processed'], 200);
    }


}
