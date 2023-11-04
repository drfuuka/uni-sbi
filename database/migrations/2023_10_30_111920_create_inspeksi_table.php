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
        Schema::create('inspeksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_inspeksi');
            $table->foreignId('inspektor_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nomor_id');
            $table->string('inspektor_sbi_area');
            $table->string('kepemilikan_alat');
            $table->string('periode_inspeksi');
            $table->string('nomor_register')->nullable();
            $table->string('email_eht')->nullable();
            $table->string('nama_perusahaan_kontraktor')->nullable();
            $table->string('syarat_inspeksi')->nullable();
            $table->foreignId('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->string('kondisi')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspeksi');
    }
};
