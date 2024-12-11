<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_absensi'; 

    protected $table = 'absensis';
    protected $fillable = ['id_karyawan', 'tanggal', 'jam_datang', 'jam_pulang', 'durasi_kerja'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
