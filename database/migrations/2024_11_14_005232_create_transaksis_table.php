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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_customer')->nullable()->constrained('customers')->onDelete('set null'); // Foreign Key untuk Customer
            $table->foreignId('id_pesanan')->nullable()->constrained('pesanans')->onDelete('set null'); // Foreign Key untuk Pesanan
            $table->date('tgl_transaksi');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->foreignId('metode_pembayaran');
            $table->enum('status_transaksi', ['Lunas', 'Belum Lunas']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
