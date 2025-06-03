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
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('judul_surat');
            $table->string('nomor_surat');
            $table->string('isi');
           $table->timestamp('tanggal_surat')->useCurrent();

            $table->string('keterangan');
            $table->enum('verifikasi', ['sudah', 'belum']);
            $table->enum('status', ['baru', 'diproses', 'selesai']);
            $table->foreignId('pengirim_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('tujuan_id')->constrained('users', 'id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
