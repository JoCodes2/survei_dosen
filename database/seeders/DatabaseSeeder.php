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

        // 1. Data Dosen (Contoh dosen dari data Anda)
        $dosenIds = [
            'd1' => Str::uuid(), // Bonitalia
            'd2' => Str::uuid(), // Muh. Andika
            'd3' => Str::uuid(), // Ir. Wildan
            'd4' => Str::uuid(), // Anwar S. Panyili
            'd5' => Str::uuid(), // Supardi Ngareng
            'd6' => Str::uuid(), // Agus Romadhona
            'd7' => Str::uuid(), // Ir. Ulfiah
            'd8' => Str::uuid(), // Sukardi
            'd9' => Str::uuid(), // Moh. Risaldi
        ];

        DB::table('dosen')->insert([
            ['id' => $dosenIds['d1'], 'nidn' => '00101', 'nama_lengkap' => 'Bonitalia, S.Pd., M.Pd', 'email' => 'bonitalia@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d2'], 'nidn' => '00102', 'nama_lengkap' => 'Muh. Andika. S.Sos, M.A.P', 'email' => 'andika@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d3'], 'nidn' => '00103', 'nama_lengkap' => 'Ir. Wildan, S.Kom., M.Kom', 'email' => 'wildan@kampus.ac.id', 'jabatan_fungsional' => 'Lektor', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d4'], 'nidn' => '00104', 'nama_lengkap' => 'Anwar S. Panyili, S.Kom., M.Kom', 'email' => 'anwar@kampus.ac.id', 'jabatan_fungsional' => 'Lektor', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d5'], 'nidn' => '00105', 'nama_lengkap' => 'Supardi Ngareng, S.Kom., M.Kom', 'email' => 'supardi@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d6'], 'nidn' => '00106', 'nama_lengkap' => 'Agus Romadhona, S.Kom., M.Kom', 'email' => 'agus@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d7'], 'nidn' => '00107', 'nama_lengkap' => 'Ir. Ulfiah, S.Pd., M.Sc', 'email' => 'ulfiah@kampus.ac.id', 'jabatan_fungsional' => 'Lektor', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d8'], 'nidn' => '00108', 'nama_lengkap' => 'Sukardi, S.Kom., M.Kom', 'email' => 'sukardi@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $dosenIds['d9'], 'nidn' => '00109', 'nama_lengkap' => 'Moh. Risaldi, S.Kom., M.Kom', 'email' => 'risaldi@kampus.ac.id', 'jabatan_fungsional' => 'Asisten Ahli', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 2. Data Program Studi
        $prodiId = Str::uuid();
        DB::table('program_studi')->insert([
            ['id' => $prodiId, 'kode_prodi' => 'TI', 'nama_prodi' => 'Teknik Informatika', 'jenjang' => 'S1', 'akreditasi' => 'A', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 3. Data Semester [cite: 4, 81]
        $semesterIds = [
            'sem1' => Str::uuid(),
            'sem3' => Str::uuid(),
        ];
        DB::table('semester')->insert([
            ['id' => $semesterIds['sem1'], 'nama_semester' => '2026/2027 Ganjil - Smt 1', 'tahun_akademik' => '2026/2027', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['id' => $semesterIds['sem3'], 'nama_semester' => '2026/2027 Ganjil - Smt 3', 'tahun_akademik' => '2026/2027', 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 4. Data Kriteria [cite: 3, 55]
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

        // 5. Data Jadwal Pengampu (Semester 1 & 3) [cite: 6, 83]
        $jadwal = [];
        // Semester 1
        $jadwal['s1_a1'] = Str::uuid();
        $jadwal['s1_a2'] = Str::uuid();
        $jadwal['s1_a3'] = Str::uuid();
        $jadwal['s1_a4'] = Str::uuid();
        $jadwal['s1_a5'] = Str::uuid();
        // Semester 3
        $jadwal['s3_a1'] = Str::uuid();
        $jadwal['s3_a2'] = Str::uuid();
        $jadwal['s3_a3'] = Str::uuid();
        $jadwal['s3_a4'] = Str::uuid();
        $jadwal['s3_a5'] = Str::uuid();

        DB::table('jadwal_pengampu')->insert([
            // Smt 1
            ['id' => $jadwal['s1_a1'], 'dosen_id' => $dosenIds['d1'], 'program_studi_id' => $prodiId, 'semester_id' => $semesterIds['sem1'], 'kode_mk' => 'MK101', 'nama_matakuliah' => 'Kalkulus', 'kelas' => 'A', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $jadwal['s1_a2'], 'dosen_id' => $dosenIds['d2'], 'program_studi_id' => $prodiId, 'semester_id' => $semesterIds['sem1'], 'kode_mk' => 'MK102', 'nama_matakuliah' => 'Pendidikan Pancasila', 'kelas' => 'A', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $jadwal['s1_a3'], 'dosen_id' => $dosenIds['d3'], 'program_studi_id' => $prodiId, 'semester_id' => $semesterIds['sem1'], 'kode_mk' => 'MK103', 'nama_matakuliah' => 'Logika Informatika', 'kelas' => 'A', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $jadwal['s1_a4'], 'dosen_id' => $dosenIds['d4'], 'program_studi_id' => $prodiId, 'semester_id' => $semesterIds['sem1'], 'kode_mk' => 'MK104', 'nama_matakuliah' => 'Aplikasi Bisnis', 'kelas' => 'A', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $jadwal['s1_a5'], 'dosen_id' => $dosenIds['d5'], 'program_studi_id' => $prodiId, 'semester_id' => $semesterIds['sem1'], 'kode_mk' => 'MK105', 'nama_matakuliah' => 'Pengantar Teknologi Informatika', 'kelas' => 'A', 'created_at' => $now, 'updated_at' => $now],
            // Smt 3
            ['id' => $jadwal['s3_a1'], 'dosen_id' => $dosenIds['d4'], 'program_studi_id' => $prodiId, 'semester_id' => $semesterIds['sem3'], 'kode_mk' => 'MK301', 'nama_matakuliah' => 'Sistem Operasi', 'kelas' => 'A', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $jadwal['s3_a2'], 'dosen_id' => $dosenIds['d6'], 'program_studi_id' => $prodiId, 'semester_id' => $semesterIds['sem3'], 'kode_mk' => 'MK302', 'nama_matakuliah' => 'Analisis & Perancangan Sistem Berbasis Objek', 'kelas' => 'A', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $jadwal['s3_a3'], 'dosen_id' => $dosenIds['d7'], 'program_studi_id' => $prodiId, 'semester_id' => $semesterIds['sem3'], 'kode_mk' => 'MK303', 'nama_matakuliah' => 'Teori Bahasa & Otomata', 'kelas' => 'A', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $jadwal['s3_a4'], 'dosen_id' => $dosenIds['d8'], 'program_studi_id' => $prodiId, 'semester_id' => $semesterIds['sem3'], 'kode_mk' => 'MK304', 'nama_matakuliah' => 'Pemrograman Terstruktur', 'kelas' => 'A', 'created_at' => $now, 'updated_at' => $now],
            ['id' => $jadwal['s3_a5'], 'dosen_id' => $dosenIds['d9'], 'program_studi_id' => $prodiId, 'semester_id' => $semesterIds['sem3'], 'kode_mk' => 'MK305', 'nama_matakuliah' => 'Pengantar Website Dasar', 'kelas' => 'A', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 6. Data Penilaian (3 Responden per Jadwal) [cite: 8, 10, 12, 14, 16, 85, 87, 89, 91, 93]
        $mahasiswaData = [
            ['nama' => 'Responden 1', 'nim' => 'MHS001'],
            ['nama' => 'Responden 2', 'nim' => 'MHS002'],
            ['nama' => 'Responden 3', 'nim' => 'MHS003'],
        ];

        // Fungsi bantu untuk insert penilaian
        $insertPenilaian = function ($jadwalId, $scores) use ($mahasiswaData, $kriteriaIds, $now) {
            foreach ($mahasiswaData as $index => $mhs) {
                foreach ($scores[$index] as $kritKey => $score) {
                    DB::table('penilaian')->insert([
                        'id' => Str::uuid(),
                        'nama_mahasiswa' => $mhs['nama'],
                        'nim' => $mhs['nim'],
                        'jadwal_pengampu_id' => $jadwalId,
                        'kriteria_id' => $kriteriaIds[$kritKey],
                        'skor' => $score,
                        'created_at' => $now,
                        'updated_at' => $now
                    ]);
                }
            }
        };

        // --- DATA PENILAIAN SEMESTER 1 ---
        // A1 [cite: 8]
        $insertPenilaian($jadwal['s1_a1'], [
            ['C1' => 4, 'C2' => 4, 'C3' => 3, 'C4' => 4],
            ['C1' => 5, 'C2' => 4, 'C3' => 4, 'C4' => 5],
            ['C1' => 4, 'C2' => 4, 'C3' => 3, 'C4' => 4],
        ]);
        // A2 [cite: 10]
        $insertPenilaian($jadwal['s1_a2'], [
            ['C1' => 3, 'C2' => 3, 'C3' => 5, 'C4' => 3],
            ['C1' => 4, 'C2' => 3, 'C3' => 5, 'C4' => 3],
            ['C1' => 3, 'C2' => 3, 'C3' => 4, 'C4' => 3],
        ]);
        // A3 [cite: 12]
        $insertPenilaian($jadwal['s1_a3'], [
            ['C1' => 5, 'C2' => 3, 'C3' => 5, 'C4' => 3],
            ['C1' => 4, 'C2' => 4, 'C3' => 5, 'C4' => 3],
            ['C1' => 4, 'C2' => 3, 'C3' => 4, 'C4' => 3],
        ]);
        // A4 [cite: 14]
        $insertPenilaian($jadwal['s1_a4'], [
            ['C1' => 4, 'C2' => 3, 'C3' => 3, 'C4' => 4],
            ['C1' => 4, 'C2' => 4, 'C3' => 4, 'C4' => 5],
            ['C1' => 4, 'C2' => 4, 'C3' => 5, 'C4' => 4],
        ]);
        // A5 [cite: 16]
        $insertPenilaian($jadwal['s1_a5'], [
            ['C1' => 3, 'C2' => 3, 'C3' => 3, 'C4' => 5],
            ['C1' => 5, 'C2' => 4, 'C3' => 5, 'C4' => 5],
            ['C1' => 3, 'C2' => 4, 'C3' => 3, 'C4' => 4],
        ]);

        // --- DATA PENILAIAN SEMESTER 3 ---
        // A1 [cite: 85]
        $insertPenilaian($jadwal['s3_a1'], [
            ['C1' => 2, 'C2' => 3, 'C3' => 1, 'C4' => 4],
            ['C1' => 3, 'C2' => 2, 'C3' => 2, 'C4' => 4],
            ['C1' => 2, 'C2' => 3, 'C3' => 1, 'C4' => 2],
        ]);
        // A2 [cite: 87]
        $insertPenilaian($jadwal['s3_a2'], [
            ['C1' => 1, 'C2' => 2, 'C3' => 3, 'C4' => 2],
            ['C1' => 2, 'C2' => 2, 'C3' => 3, 'C4' => 2],
            ['C1' => 1, 'C2' => 3, 'C3' => 2, 'C4' => 2],
        ]);
        // A3 [cite: 89]
        $insertPenilaian($jadwal['s3_a3'], [
            ['C1' => 3, 'C2' => 2, 'C3' => 4, 'C4' => 2],
            ['C1' => 3, 'C2' => 3, 'C3' => 4, 'C4' => 2],
            ['C1' => 2, 'C2' => 2, 'C3' => 3, 'C4' => 2],
        ]);
        // A4 [cite: 91]
        $insertPenilaian($jadwal['s3_a4'], [
            ['C1' => 4, 'C2' => 3, 'C3' => 2, 'C4' => 4],
            ['C1' => 4, 'C2' => 4, 'C3' => 3, 'C4' => 5],
            ['C1' => 3, 'C2' => 3, 'C3' => 3, 'C4' => 4],
        ]);
        // A5 [cite: 93]
        $insertPenilaian($jadwal['s3_a5'], [
            ['C1' => 2, 'C2' => 2, 'C3' => 2, 'C4' => 4],
            ['C1' => 3, 'C2' => 3, 'C3' => 3, 'C4' => 5],
            ['C1' => 2, 'C2' => 3, 'C3' => 2, 'C4' => 4],
        ]);
    }
}
