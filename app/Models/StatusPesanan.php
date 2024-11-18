<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPesanan extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'status_pesanans';
    
    // Primary key jika bukan `id`
    protected $primaryKey = 'id_status';
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_pesanan',
        'nama_pemesan',
        'detail_pesanan',
        'status'
    ];
}
