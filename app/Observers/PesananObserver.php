<?php

namespace App\Observers;

use App\Models\Pesanan;
use App\Models\Transaksi;

class PesananObserver
{
    /**
     * Handle the Pesanan "created" event.
     */
    public function created(Pesanan $pesanan)
    {
        Transaksi::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'tgl_transaksi' => now(),
            'nama_pemesan' => $pesanan->nama_pemesan, // Pastikan nilai ini ada
            'menu_id' => $pesanan->menu_id,
            'harga' => $pesanan->menu->harga,
            'total_pembayaran' => $pesanan->jumlah_pesanan * $pesanan->menu->harga,
            'jumlah_pesanan' => $pesanan->jumlah_pesanan,
            // Menambahkan nilai default untuk kolom lainnya jika diperlukan
        ]);
    }


    /**
     * Handle the Pesanan "updated" event.
     */
    public function updated(Pesanan $pesanan): void
    {
        //
    }

    /**
     * Handle the Pesanan "deleted" event.
     */
    public function deleted(Pesanan $pesanan): void
    {
        //
    }

    /**
     * Handle the Pesanan "restored" event.
     */
    public function restored(Pesanan $pesanan): void
    {
        //
    }

    /**
     * Handle the Pesanan "force deleted" event.
     */
    public function forceDeleted(Pesanan $pesanan): void
    {
        //
    }
}
