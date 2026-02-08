<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_jadwal_pengampu_table.php
    public function up(): void
    {
        Schema::create('jadwal_pengampu', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('dosen_id')->constrained('dosen')->onDelete('cascade');
            $table->foreignUuid('program_studi_id')->constrained('program_studi')->onDelete('cascade');
            $table->foreignUuid('semester_id')->constrained('semester')->onDelete('cascade');
            $table->string('kode_mk', 20);
            $table->string('nama_matakuliah', 255);
            $table->string('kelas', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pengampu');
    }
};
