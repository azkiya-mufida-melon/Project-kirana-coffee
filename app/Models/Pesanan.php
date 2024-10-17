<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pesanan',
        'id_customer',
        'id_menu',
        'id_status',
        'id_pegawai',
        'bukti_pembayaran',
        'nama_pemesan',
        'tgl_pesan',
        'total_pembayaran',

    ];
}
