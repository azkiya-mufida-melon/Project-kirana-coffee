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
            $table->foreignId('id_pesanan')->constrained('pesanans')->onDelete('cascade');            
            $table->date('tgl_transaksi');
            $table->decimal('total_bayar', 10, 2)->nullable()->change();
            $table->integer('jumlah_pesanan');
            $table->enum('metode_pembayaran', allowed: ['Cash', 'QRIS'])->nullable()->change();
            $table->enum('status_transaksi', ['Lunas', 'Belum Lunas'])->nullable()->change();

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
