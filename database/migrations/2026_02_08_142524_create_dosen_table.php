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
        Schema::create('dosen', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nidn', 20)->unique();
            $table->string('nama_lengkap', 255);
            $table->string('gelar_depan', 50)->nullable();
            $table->string('gelar_belakang', 100)->nullable();
            $table->string('jenis_kelamin', 10);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->string('email', 100);
            $table->string('no_telp', 20);
            $table->text('alamat');
            $table->string('jabatan_fungsional', 100)->nullable();
            $table->string('status_kepegawaian', 50)->nullable();
            $table->string('pendidikan_terakhir', 50)->nullable();
            $table->string('foto', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
