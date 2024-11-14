<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_customer')->nullable()->constrained('customers')->onDelete('set null');
            $table->foreignId('id_pesanan')->nullable()->constrained('pesanans')->onDelete('set null');
            $table->date('tgl_transaksi');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->string('metode_pembayaran');
            $table->enum('status_transaksi', ['Lunas', 'Belum Lunas']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};

