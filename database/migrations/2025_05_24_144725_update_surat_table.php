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
        Schema::table('surat', function (Blueprint $table) {
            $table->foreignId('verifikator_id')->after('disposisi_id')->constrained('verifikator', 'id');
            $table->foreignId('penandatangan_id')->after('verifikator_id')->constrained('penandatangan', 'id');
            $table->foreignId('gruptujuan_id')->after('verifikator_id')->nullable()->constrained('grup_tujuan', 'id');
            $table->enum('sifat_surat', ['biasa', 'penting', 'rahasia', 'sangat rahasia'])->after('nomor_surat')->default('biasa');
            $table->enum('jenis_surat', ['NOTA DINAS', 'SURAT PERINTAH'])->after('sifat_surat');
            $table->dropConstrainedForeignId('disposisi_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat', function (Blueprint $table) {
            $table->dropColumn('verifikator_id');
            $table->dropColumn('penandatangan_id');
            $table->dropColumn('gruptujuan_id');
            $table->dropColumn('sifat_surat');
            $table->dropColumn('jenis_surat');
        });
    }
};
