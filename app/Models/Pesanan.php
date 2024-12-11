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
        'nama_pemesan',
        'tgl_pesan',
        'total_pembayaran',
        'jumlah_pesanan',
        'harga',
        'username_pegawai',

    ];

    protected $primaryKey = 'id_pesanan'; // Menentukan kolom primary key
    public $incrementing = true; // Menandakan kolom sebagai auto-increment
    protected $keyType = 'int'; // Tipe data kunci utama

    public function menu()
    {
    return $this->belongsTo(Menu::class, 'id_menu'); // Sesuaikan 'id_menu' dengan kolom foreign key di tabel pesanan
    }

    public function transaksi()
    {
    return $this->hasOne(Transaksi::class);
    }
// Di model Pesanan
    public function user()
    {
        return $this->belongsTo(User::class, 'username_pegawai', 'username');
    }


}

