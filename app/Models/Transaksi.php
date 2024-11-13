<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis'; // pastikan mengarah ke tabel yang benar

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_customer',
        'id_pesanan',
        'tgl_transaksi',
        'jumlah_bayar',
        'metode_pembayaran', // pastikan tipe datanya benar
        'status_transaksi',
    ];
}
