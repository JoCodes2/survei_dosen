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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_mahasiswa');
            $table->string('nim', 20);
            $table->foreignUuid('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignUuid('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->integer('skor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
