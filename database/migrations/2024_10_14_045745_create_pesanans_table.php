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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_customer')->nullable()->constrained('customers')->onDelete('set null'); // Foreign Key untuk Customer
            $table->foreignId('id_menu')->nullable()->constrained('menus')->onDelete('set null'); // Foreign Key untuk Menu
            $table->foreignId('id_status')->nullable()->constrained('statuses')->onDelete('set null'); // Foreign Key untuk Status
            $table->foreignId('id_pegawai')->nullable()->constrained('pegawais')->onDelete('set null'); // Foreign Key untuk Pegawai
            $table->string('nama_pemesan'); // Nama Pemesan
            $table->date('tgl_pesan'); // Tanggal Pesan
            $table->decimal('total_pembayaran', 10, 2); // Total Pembayaran
            $table->integer('jumlah_pesanan');
            $table->decimal('harga');
            $table->string('username_pegawai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
