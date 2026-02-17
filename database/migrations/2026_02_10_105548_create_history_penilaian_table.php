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
        Schema::create('history_penilaian', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Relasi untuk Filter
            $table->foreignUuid('semester_id')->constrained('semester');
            $table->foreignUuid('program_studi_id')->constrained('program_studi');
            $table->foreignUuid('dosen_id')->constrained('dosen');

            $table->double('nilai_akhir_f');
            $table->integer('peringkat');

            $table->double('nilai_si_ideal');
            $table->double('nilai_si_buruk');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_penilaian');
    }
};
