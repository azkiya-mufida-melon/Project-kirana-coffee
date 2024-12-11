<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_karyawan',
        'nama',
        'evaluasi_terakhir',
        'jumlah_pelayanan',
        'jam_kerja',
        'lama_bekerja',
    ];
}
