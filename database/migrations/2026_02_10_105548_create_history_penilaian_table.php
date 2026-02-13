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

            // Hasil MARCOS
            $table->double('nilai_akhir_f'); // F(ki)
            $table->integer('peringkat');

            // Konteks Nilai Ideal/Buruk pada periode tersebut
            $table->double('nilai_si_ideal'); // S-AI tertinggi pada semester/prodi tersebut
            $table->double('nilai_si_buruk'); // S-AAI terendah pada semester/prodi tersebut

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
