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
        Schema::create('grup_tujuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_grup');
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::create('grup_tujuan_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grup_tujuan_id')->constrained('grup_tujuan')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grup_tujuan_user');
        Schema::dropIfExists('grup_tujuan');
    }
};
