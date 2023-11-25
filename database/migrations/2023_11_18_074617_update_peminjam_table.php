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
        Schema::table('peminjam', function (Blueprint $table) {
            $table->dropColumn('nama_peminjam');
            $table->dropColumn('jabatan');
            $table->dropColumn('department');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjam', function (Blueprint $table) {
            $table->string('nama_peminjam');
            $table->string('jabatan');
            $table->string('department');
        });
    }
};
