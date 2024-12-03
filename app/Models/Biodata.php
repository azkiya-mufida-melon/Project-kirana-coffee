<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_biodata';

    protected $fillable = [
        'id_biodata',
        'nama',
        'jenis_kelamin',
        'tgl_lahir',
        'no_telp',
        'alamat',
        'email',
        'jabatan',
        'foto_profil',
        'lama_bekerja',
    ];


}
