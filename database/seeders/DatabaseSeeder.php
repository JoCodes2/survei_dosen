<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Master (Prodi, Semester)
        $prodiId = Str::uuid();
        DB::table('program_studi')->insert([
            'id' => $prodiId,
            'kode_prodi' => 'TI',
            'nama_prodi' => 'Teknik Informatika',
        ]);

        $semesterId = Str::uuid();
        DB::table('semester')->insert([
            'id' => $semesterId,
            'nama_semester' => 'Semester 1',
            'tahun_akademik' => '2025/2026',
            'is_active' => true,
        ]);

        // 2. Kriteria (Bobot & Jenis)
        $kC1 = Str::uuid();
        $kC2 = Str::uuid();
        $kC3 = Str::uuid();
        $kC4 = Str::uuid();

        DB::table('kriteria')->insert([
            ['id' => $kC1, 'kode_kriteria' => 'C1', 'nama_kriteria' => 'Frekuensi komunikasi', 'jenis' => 'benefit', 'bobot' => 0.2],
            ['id' => $kC2, 'kode_kriteria' => 'C2', 'nama_kriteria' => 'Bimbingan perkuliahan', 'jenis' => 'benefit', 'bobot' => 0.1],
            ['id' => $kC3, 'kode_kriteria' => 'C3', 'nama_kriteria' => 'Kecepatan respons', 'jenis' => 'benefit', 'bobot' => 0.3],
            ['id' => $kC4, 'kode_kriteria' => 'C4', 'nama_kriteria' => 'Kepuasan mahasiswa', 'jenis' => 'benefit', 'bobot' => 0.4],
        ]);

        $criteriaIds = [$kC1, $kC2, $kC3, $kC4];

        // 3. Dosen & Kelas (5 Dosen, 5 Kelas)
        $dosenList = [
            ['nama' => 'Bonitalia, S.Pd., M.Pd', 'email' => 'boni@univ.ac.id'], // A1
            ['nama' => 'Muh. Andika. S.Sos, M.A.P', 'email' => 'andika@univ.ac.id'], // A2
            ['nama' => 'Ir. Wildan, S.Kom., M.Kom', 'email' => 'wildan@univ.ac.id'], // A3
            ['nama' => 'Anwar S. Panyili, S.Kom., M.Kom', 'email' => 'anwar@univ.ac.id'], // A4
            ['nama' => 'Supardi Ngareng, S.Kom., M.Kom', 'email' => 'supardi@univ.ac.id'], // A5
        ];

        // Data skor yang disesuaikan dengan contoh kasus (Fleksibel)
        $skorDataByDosen = [
            // A1: 3 Responden
            'A1' => [
                ['MHS001', 'Mahasiswa R1', [4, 4, 3, 4]],
                ['MHS002', 'Mahasiswa R2', [5, 4, 4, 5]],
                ['MHS003', 'Mahasiswa R3', [4, 4, 3, 4]],
            ],
            // A2: 3 Responden
            'A2' => [
                ['MHS001', 'Mahasiswa R1', [3, 3, 5, 3]],
                ['MHS002', 'Mahasiswa R2', [4, 3, 5, 3]],
                ['MHS003', 'Mahasiswa R3', [3, 3, 4, 3]],
            ],
            // A3: 3 Responden
            'A3' => [
                ['MHS001', 'Mahasiswa R1', [5, 3, 5, 3]],
                ['MHS002', 'Mahasiswa R2', [4, 4, 5, 3]],
                ['MHS003', 'Mahasiswa R3', [4, 3, 4, 3]],
            ],
            // A4: 3 Responden
            'A4' => [
                ['MHS001', 'Mahasiswa R1', [4, 3, 3, 4]],
                ['MHS002', 'Mahasiswa R2', [4, 4, 4, 5]],
                ['MHS003', 'Mahasiswa R3', [4, 4, 5, 4]],
            ],
            // A5: 2 Responden saja (sesuai contoh kendala Anda)
            'A5' => [
                ['MHS001', 'Mahasiswa R1', [3, 3, 3, 5]],
                ['MHS002', 'Mahasiswa R2', [5, 4, 5, 5]],
                ['MHS002', 'Mahasiswa R2', [3, 4, 3, 4]],
            ],
        ];

        $dataPenilaian = [];

        foreach ($dosenList as $index => $dosenData) {
            // Insert Dosen
            $dosenId = Str::uuid();
            DB::table('dosen')->insert([
                'id' => $dosenId,
                'nama_lengkap' => $dosenData['nama'],
                'email' => $dosenData['email'],
            ]);

            // Insert Kelas untuk Dosen tersebut
            $kelasId = Str::uuid();
            DB::table('kelas')->insert([
                'id' => $kelasId,
                'dosen_id' => $dosenId,
                'program_studi_id' => $prodiId,
                'semester_id' => $semesterId,
            ]);

            // Mengambil key 'A1' - 'A5'
            $dosenKey = 'A' . ($index + 1);

            // Loop berdasarkan jumlah data survei yang ada
            if (isset($skorDataByDosen[$dosenKey])) {
                foreach ($skorDataByDosen[$dosenKey] as $survei) {
                    $nim = $survei[0];
                    $namaMhs = $survei[1];
                    $skorKriteria = $survei[2];

                    foreach ($criteriaIds as $critIndex => $criteriaId) {
                        $dataPenilaian[] = [
                            'id' => Str::uuid(),
                            'nama_mahasiswa' => $namaMhs,
                            'nim' => $nim,
                            'kelas_id' => $kelasId,
                            'kriteria_id' => $criteriaId,
                            'skor' => $skorKriteria[$critIndex],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }
        }

        // Insert semua data penilaian sekaligus
        DB::table('penilaian')->insert($dataPenilaian);
    }
}
