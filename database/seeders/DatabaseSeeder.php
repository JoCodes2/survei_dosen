<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Data Dosen (Wajib hanya 5 dosen)
        $dosenIds = [
            'd1' => Str::uuid(),
            'd2' => Str::uuid(),
            'd3' => Str::uuid(),
            'd4' => Str::uuid(),
            'd5' => Str::uuid(),
        ];

        DB::table('dosen')->insert([
            ['id' => $dosenIds['d1'], 'nidn' => '00101', 'nama_lengkap' => 'Dr. Budi Santoso', 'email' => 'budi@kampus.ac.id', 'jabatan_fungsional' => 'Lektor', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d2'], 'nidn' => '00102', 'nama_lengkap' => 'Siti Aminah, M.Kom', 'email' => 'siti@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d3'], 'nidn' => '00103', 'nama_lengkap' => 'Prof. Andi Wijaya', 'email' => 'andi@kampus.ac.id', 'jabatan_fungsional' => 'Lektor Kepala', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d4'], 'nidn' => '00104', 'nama_lengkap' => 'Rina Kartika, M.T', 'email' => 'rina@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d5'], 'nidn' => '00105', 'nama_lengkap' => 'Eko Prasetyo, S.Kom', 'email' => 'eko@kampus.ac.id', 'jabatan_fungsional' => 'Tenaga Pengajar', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 2. Data Program Studi (Teknik Informatika & Sistem Informasi)
        $prodiTI = Str::uuid();
        $prodiSI = Str::uuid();
        DB::table('program_studi')->insert([
            ['id' => $prodiTI, 'kode_prodi' => 'TI', 'nama_prodi' => 'Teknik Informatika', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $prodiSI, 'kode_prodi' => 'SI', 'nama_prodi' => 'Sistem Informasi', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 3. Data Semester
        $semesterIds = [
            'sem1' => Str::uuid(),
            'sem3' => Str::uuid(),
        ];
        DB::table('semester')->insert([
            ['id' => $semesterIds['sem1'], 'nama_semester' => '2026/2027 Ganjil - Smt 1', 'tahun_akademik' => '2026/2027', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['id' => $semesterIds['sem3'], 'nama_semester' => '2026/2027 Ganjil - Smt 3', 'tahun_akademik' => '2026/2027', 'is_active' => false, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 4. Data Kriteria
        $kriteriaIds = [
            'C1' => Str::uuid(),
            'C2' => Str::uuid(),
            'C3' => Str::uuid(),
            'C4' => Str::uuid(),
        ];
        DB::table('kriteria')->insert([
            ['id' => $kriteriaIds['C1'], 'kode_kriteria' => 'C1', 'nama_kriteria' => 'Frekuensi komunikasi', 'bobot' => 0.2, 'jenis' => 'benefit', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $kriteriaIds['C2'], 'kode_kriteria' => 'C2', 'nama_kriteria' => 'Bimbingan perkuliahan', 'bobot' => 0.1, 'jenis' => 'benefit', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $kriteriaIds['C3'], 'kode_kriteria' => 'C3', 'nama_kriteria' => 'Kecepatan respons', 'bobot' => 0.3, 'jenis' => 'benefit', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $kriteriaIds['C4'], 'kode_kriteria' => 'C4', 'nama_kriteria' => 'Kepuasan mahasiswa', 'bobot' => 0.4, 'jenis' => 'benefit', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 5. Data Kelas (TI dan SI)
        $kelasIds = [
            'ti11' => Str::uuid(), // TI 1.1 - Survei
            'ti31' => Str::uuid(), // TI 3.1 - Survei
            'si11' => Str::uuid(), // SI 1.1 - Tidak Survei
            'si31' => Str::uuid(), // SI 3.1 - Tidak Survei
        ];

        DB::table('kelas')->insert([
            // --- DATA TI ---
            ['id' => $kelasIds['ti11'], 'dosen_id' => $dosenIds['d1'], 'program_studi_id' => $prodiTI, 'semester_id' => $semesterIds['sem1'], 'kelas' => 'TI 1.1', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $kelasIds['ti31'], 'dosen_id' => $dosenIds['d2'], 'program_studi_id' => $prodiTI, 'semester_id' => $semesterIds['sem3'], 'kelas' => 'TI 3.1', 'created_at' => $now, 'updated_at' => $now],

            // --- DATA SI ---
            ['id' => $kelasIds['si11'], 'dosen_id' => $dosenIds['d3'], 'program_studi_id' => $prodiSI, 'semester_id' => $semesterIds['sem1'], 'kelas' => 'SI 1.1', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $kelasIds['si31'], 'dosen_id' => $dosenIds['d4'], 'program_studi_id' => $prodiSI, 'semester_id' => $semesterIds['sem3'], 'kelas' => 'SI 3.1', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 6. Data Penilaian (Hanya Semester 1 TI dan Semester 3 TI)
        $mahasiswaData = [
            ['nama' => 'Responden 1', 'nim' => 'MHS001'],
            ['nama' => 'Responden 2', 'nim' => 'MHS002'],
            ['nama' => 'Responden 3', 'nim' => 'MHS003'],
        ];

        // Fungsi bantu untuk insert penilaian
        $insertPenilaian = function ($kelasId, $scores) use ($mahasiswaData, $kriteriaIds, $now) {
            foreach ($mahasiswaData as $index => $mhs) {
                foreach ($scores[$index] as $kritKey => $score) {
                    DB::table('penilaian')->insert([
                        'id' => Str::uuid(),
                        'nama_mahasiswa' => $mhs['nama'],
                        'nim' => $mhs['nim'],
                        'kelas_id' => $kelasId,
                        'kriteria_id' => $kriteriaIds[$kritKey],
                        'skor' => $score,
                        'created_at' => $now,
                        'updated_at' => $now
                    ]);
                }
            }
        };

        // --- DATA PENILAIAN SEMESTER 1 TI (TI 1.1) ---
        $scoresTI11 = [
            ['C1' => 4, 'C2' => 4, 'C3' => 3, 'C4' => 4],
            ['C1' => 5, 'C2' => 4, 'C3' => 4, 'C4' => 5],
            ['C1' => 4, 'C2' => 4, 'C3' => 3, 'C4' => 4]
        ];
        $insertPenilaian($kelasIds['ti11'], $scoresTI11);

        // --- DATA PENILAIAN SEMESTER 3 TI (TI 3.1) ---
        $scoresTI31 = [
            ['C1' => 2, 'C2' => 3, 'C3' => 1, 'C4' => 4],
            ['C1' => 3, 'C2' => 2, 'C3' => 2, 'C4' => 4],
            ['C1' => 2, 'C2' => 3, 'C3' => 1, 'C4' => 2]
        ];
        $insertPenilaian($kelasIds['ti31'], $scoresTI31);

        // Catatan: Kelas SI 1.1 dan SI 3.1 tidak memiliki data penilaian.
    }
}
