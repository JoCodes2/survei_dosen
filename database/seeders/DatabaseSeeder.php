<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // ===================== DOSEN =====================
        $dosenIds = [
            'd1' => Str::uuid(),
            'd2' => Str::uuid(),
            'd3' => Str::uuid(),
            'd4' => Str::uuid(),
            'd5' => Str::uuid(),
            'd6' => Str::uuid(),
            'd7' => Str::uuid(),
            'd8' => Str::uuid(),
            'd9' => Str::uuid(),
        ];

        DB::table('dosen')->insert([
            ['id' => $dosenIds['d1'], 'nidn' => '00101', 'nama_lengkap' => 'Bonitalia, S.Pd., M.Pd', 'email' => 'bonitalia@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d2'], 'nidn' => '00102', 'nama_lengkap' => 'Muh. Andika, S.Sos, M.A.P', 'email' => 'andika@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d3'], 'nidn' => '00103', 'nama_lengkap' => 'Ir. Wildan, S.Kom., M.Kom', 'email' => 'wildan@kampus.ac.id', 'jabatan_fungsional' => 'Lektor', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d4'], 'nidn' => '00104', 'nama_lengkap' => 'Anwar S. Panyili, S.Kom., M.Kom', 'email' => 'anwar@kampus.ac.id', 'jabatan_fungsional' => 'Lektor', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d5'], 'nidn' => '00105', 'nama_lengkap' => 'Supardi Ngareng, S.Kom., M.Kom', 'email' => 'supardi@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d6'], 'nidn' => '00106', 'nama_lengkap' => 'Agus Romadhona, S.Kom., M.Kom', 'email' => 'agus@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d7'], 'nidn' => '00107', 'nama_lengkap' => 'Ir. Ulfiah, S.Pd., M.Sc', 'email' => 'ulfiah@kampus.ac.id', 'jabatan_fungsional' => 'Lektor', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d8'], 'nidn' => '00108', 'nama_lengkap' => 'Sukardi, S.Kom., M.Kom', 'email' => 'sukardi@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d9'], 'nidn' => '00109', 'nama_lengkap' => 'Moh. Risaldi, S.Kom., M.Kom', 'email' => 'risaldi@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // ===================== PROGRAM STUDI =====================
        $prodiTI = Str::uuid();
        $prodiSI = Str::uuid();

        DB::table('program_studi')->insert([
            ['id' => $prodiTI, 'kode_prodi' => 'TI', 'nama_prodi' => 'Teknik Informatika',   'created_at' => $now, 'updated_at' => $now],
            ['id' => $prodiSI, 'kode_prodi' => 'SI', 'nama_prodi' => 'Sistem Informasi',  'created_at' => $now, 'updated_at' => $now],
        ]);

        // ===================== SEMESTER =====================
        $semesterIds = [
            'sem1' => Str::uuid(),
            'sem3' => Str::uuid(),
            'sem5' => Str::uuid(),
            'sem7' => Str::uuid(),
        ];

        DB::table('semester')->insert([
            ['id' => $semesterIds['sem1'], 'nama_semester' => '2026/2027 Ganjil - Smt 1', 'tahun_akademik' => '2026/2027', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['id' => $semesterIds['sem3'], 'nama_semester' => '2026/2027 Ganjil - Smt 3', 'tahun_akademik' => '2026/2027', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['id' => $semesterIds['sem5'], 'nama_semester' => '2026/2027 Ganjil - Smt 5', 'tahun_akademik' => '2026/2027', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['id' => $semesterIds['sem7'], 'nama_semester' => '2026/2027 Ganjil - Smt 7', 'tahun_akademik' => '2026/2027', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // ===================== JADWAL PENGAMPU =====================
        DB::table('kelas')->insert([
            // TI
            ['id' => Str::uuid(), 'dosen_id' => $dosenIds['d1'], 'program_studi_id' => $prodiTI, 'semester_id' => $semesterIds['sem1'], 'kelas' => 'TI 1.1', 'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'dosen_id' => $dosenIds['d2'], 'program_studi_id' => $prodiTI, 'semester_id' => $semesterIds['sem3'], 'kelas' => 'TI 1.1', 'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'dosen_id' => $dosenIds['d3'], 'program_studi_id' => $prodiTI, 'semester_id' => $semesterIds['sem5'], 'kelas' => 'TI 1.1', 'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'dosen_id' => $dosenIds['d4'], 'program_studi_id' => $prodiTI, 'semester_id' => $semesterIds['sem7'], 'kelas' => 'TI 1.1', 'created_at' => $now, 'updated_at' => $now],

            // SI
            ['id' => Str::uuid(), 'dosen_id' => $dosenIds['d5'], 'program_studi_id' => $prodiSI, 'semester_id' => $semesterIds['sem1'], 'kelas' => 'SI 1.1', 'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'dosen_id' => $dosenIds['d6'], 'program_studi_id' => $prodiSI, 'semester_id' => $semesterIds['sem3'], 'kelas' => 'SI 1.1', 'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'dosen_id' => $dosenIds['d7'], 'program_studi_id' => $prodiSI, 'semester_id' => $semesterIds['sem5'], 'kelas' => 'SI 1.1', 'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'dosen_id' => $dosenIds['d8'], 'program_studi_id' => $prodiSI, 'semester_id' => $semesterIds['sem7'], 'kelas' => 'SI 1.1', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
