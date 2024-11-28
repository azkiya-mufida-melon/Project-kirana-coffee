<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_transaksi',
        'id_customer',
        'id_pesanan',
        'tgl_transaksi',
        'total_bayar',
        'jumlah_pesanan',
        'metode_pembayaran',
        'status_transaksi',
    ];
    
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'id_pesanan');
    }
}
