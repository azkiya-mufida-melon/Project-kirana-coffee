<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('laporans', function (Blueprint $table) {
        $table->id('id_laporan'); // ID untuk laporan
        $table->bigInteger('id_pesanan'); // Relasi ke tabel pesanan (foreign key)
        $table->date('tgl_laporan'); // Tanggal laporan
        $table->timestamps(); // timestamps untuk created_at dan updated_at
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
