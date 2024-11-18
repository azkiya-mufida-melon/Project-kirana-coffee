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
            $table->id('id_laporan'); // ID Laporan as primary key
            $table->unsignedBigInteger('id_pesanan'); // ID Pesanan as foreign key
            $table->date('tgl_laporan'); // Tanggal laporan
            $table->timestamps();

            // Optional: Foreign key constraint linking id_pesanan with id in pesanan table
            $table->foreign('id_pesanan')->references('id')->on('pesanans')->onDelete('cascade');
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
