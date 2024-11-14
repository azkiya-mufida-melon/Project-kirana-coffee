<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus'; // Nama tabel
    protected $primaryKey = 'id_menu'; // Menggunakan id_menu sebagai primary key

    protected $fillable = [
        'id_menu',
        'gambar_menu',
        'nama_menu',
        'detail_menu',
        'harga',
        'stok',
        'id_kategori',
    ];

    public function menu()
    {
    return $this->belongsTo(Menu::class, 'id_menu'); // Sesuaikan 'id_menu' dengan kolom foreign key di tabel pesanan
    }
}
