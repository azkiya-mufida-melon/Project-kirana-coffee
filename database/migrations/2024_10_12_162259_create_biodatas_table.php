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
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id('id_biodata');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->date('tgl_lahir');
            $table->string('no_telp');
            $table->text('alamat');
            $table->string('email');
            $table->enum('jabatan', ['Owner', 'Barista', 'Kasir', 'Koki Snack']);
            $table->string('foto_profil')->nullable();
            $table->date('lama_bekerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodatas');
    }
};
