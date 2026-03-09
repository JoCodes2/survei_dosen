<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MarcosDummySeeder extends Seeder
{
    public function run(): void
    {
        DB::beginTransaction();

        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            DB::table('penilaian')->delete();
            DB::table('kelas')->delete();
            DB::table('dosen')->delete();
            DB::table('kriteria')->delete();
            DB::table('semester')->delete();
            DB::table('program_studi')->delete();

            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            $now = now();

            /*
            |--------------------------------------------------------------------------
            | 1. PROGRAM STUDI
            |--------------------------------------------------------------------------
            */
            $programStudiId = (string) Str::uuid();

            DB::table('program_studi')->insert([
                'id' => $programStudiId,
                'kode_prodi' => 'TI',
                'nama_prodi' => 'Teknik Informatika',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            /*
            |--------------------------------------------------------------------------
            | 2. SEMESTER
            |--------------------------------------------------------------------------
            */
            $semesterId = (string) Str::uuid();

            DB::table('semester')->insert([
                'id' => $semesterId,
                'nama_semester' => 'Semester 1',
                'tahun_akademik' => '2025/2026',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            /*
            |--------------------------------------------------------------------------
            | 3. KRITERIA
            |--------------------------------------------------------------------------
            */
            $kriteriaIds = [
                'C1' => (string) Str::uuid(),
                'C2' => (string) Str::uuid(),
                'C3' => (string) Str::uuid(),
                'C4' => (string) Str::uuid(),
            ];

            DB::table('kriteria')->insert([
                [
                    'id' => $kriteriaIds['C1'],
                    'kode_kriteria' => 'C1',
                    'nama_kriteria' => 'Frekuensi komunikasi',
                    'bobot' => 0.2,
                    'jenis' => 'benefit',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $kriteriaIds['C2'],
                    'kode_kriteria' => 'C2',
                    'nama_kriteria' => 'Bimbingan perkuliahan',
                    'bobot' => 0.1,
                    'jenis' => 'benefit',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $kriteriaIds['C3'],
                    'kode_kriteria' => 'C3',
                    'nama_kriteria' => 'Kecepatan respons',
                    'bobot' => 0.3,
                    'jenis' => 'benefit',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $kriteriaIds['C4'],
                    'kode_kriteria' => 'C4',
                    'nama_kriteria' => 'Kepuasan mahasiswa',
                    'bobot' => 0.4,
                    'jenis' => 'benefit',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]);

            /*
            |--------------------------------------------------------------------------
            | 4. DOSEN (A1 - A5)
            |--------------------------------------------------------------------------
            */
            $dosenIds = [
                'A1' => (string) Str::uuid(),
                'A2' => (string) Str::uuid(),
                'A3' => (string) Str::uuid(),
                'A4' => (string) Str::uuid(),
                'A5' => (string) Str::uuid(),
            ];

            DB::table('dosen')->insert([
                [
                    'id' => $dosenIds['A1'],
                    'nidn' => '1000000001',
                    'nama_lengkap' => 'Bonitalia, S.Pd., M.Pd',
                    'email' => 'bonitalia@example.com',
                    'jabatan_fungsional' => 'Dosen',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $dosenIds['A2'],
                    'nidn' => '1000000002',
                    'nama_lengkap' => 'Muh. Andika. S.Sos, M.A.P',
                    'email' => 'andika@example.com',
                    'jabatan_fungsional' => 'Dosen',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $dosenIds['A3'],
                    'nidn' => '1000000003',
                    'nama_lengkap' => 'Ir. Wildan, S.Kom., M.Kom',
                    'email' => 'wildan@example.com',
                    'jabatan_fungsional' => 'Dosen',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $dosenIds['A4'],
                    'nidn' => '1000000004',
                    'nama_lengkap' => 'Anwar S. Panyili, S.Kom., M.Kom',
                    'email' => 'anwar@example.com',
                    'jabatan_fungsional' => 'Dosen',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $dosenIds['A5'],
                    'nidn' => '1000000005',
                    'nama_lengkap' => 'Supardi Ngareng, S.Kom., M.Kom',
                    'email' => 'supardi@example.com',
                    'jabatan_fungsional' => 'Dosen',
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]);

            /*
            |--------------------------------------------------------------------------
            | 5. KELAS
            |--------------------------------------------------------------------------
            */
            $kelasIds = [
                'A1' => (string) Str::uuid(),
                'A2' => (string) Str::uuid(),
                'A3' => (string) Str::uuid(),
                'A4' => (string) Str::uuid(),
                'A5' => (string) Str::uuid(),
            ];

            DB::table('kelas')->insert([
                [
                    'id' => $kelasIds['A1'],
                    'dosen_id' => $dosenIds['A1'],
                    'program_studi_id' => $programStudiId,
                    'semester_id' => $semesterId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $kelasIds['A2'],
                    'dosen_id' => $dosenIds['A2'],
                    'program_studi_id' => $programStudiId,
                    'semester_id' => $semesterId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $kelasIds['A3'],
                    'dosen_id' => $dosenIds['A3'],
                    'program_studi_id' => $programStudiId,
                    'semester_id' => $semesterId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $kelasIds['A4'],
                    'dosen_id' => $dosenIds['A4'],
                    'program_studi_id' => $programStudiId,
                    'semester_id' => $semesterId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'id' => $kelasIds['A5'],
                    'dosen_id' => $dosenIds['A5'],
                    'program_studi_id' => $programStudiId,
                    'semester_id' => $semesterId,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ]);

            /*
            |--------------------------------------------------------------------------
            | 6. DATA NILAI MANUAL
            |--------------------------------------------------------------------------
            | Data ini dibuat agar rata-rata sama dengan perhitungan Word:
            |
            | A1:
            | C1=(4+5+4)/3=4.33, C2=(4+4+4)/3=4.00, C3=(3+4+3)/3=3.33, C4=(4+5+4)/3=4.33
            | A2:
            | C1=(3+4+3)/3=3.33, C2=(3+3+3)/3=3.00, C3=(5+5+4)/3=4.67, C4=(3+3+3)/3=3.00
            | A3:
            | C1=(5+4+4)/3=4.33, C2=(3+4+3)/3=3.33, C3=(5+5+4)/3=4.67, C4=(3+3+3)/3=3.00
            | A4:
            | C1=(4+4+4)/3=4.00, C2=(3+4+4)/3=3.67, C3=(3+4+5)/3=4.00, C4=(4+5+4)/3=4.33
            | A5:
            | C1=(3+5+3)/3=3.67, C2=(3+4+4)/3=3.67, C3=(3+5+3)/3=3.67, C4=(5+5+4)/3=4.67
            |--------------------------------------------------------------------------
            */
            $nilaiManual = [
                'A1' => [
                    'C1' => [4, 5, 4],
                    'C2' => [4, 4, 4],
                    'C3' => [3, 4, 3],
                    'C4' => [4, 5, 4],
                ],
                'A2' => [
                    'C1' => [3, 4, 3],
                    'C2' => [3, 3, 3],
                    'C3' => [5, 5, 4],
                    'C4' => [3, 3, 3],
                ],
                'A3' => [
                    'C1' => [5, 4, 4],
                    'C2' => [3, 4, 3],
                    'C3' => [5, 5, 4],
                    'C4' => [3, 3, 3],
                ],
                'A4' => [
                    'C1' => [4, 4, 4],
                    'C2' => [3, 4, 4],
                    'C3' => [3, 4, 5],
                    'C4' => [4, 5, 4],
                ],
                'A5' => [
                    'C1' => [3, 5, 3],
                    'C2' => [3, 4, 4],
                    'C3' => [3, 5, 3],
                    'C4' => [5, 5, 4],
                ],
            ];

            /*
            |--------------------------------------------------------------------------
            | 7. PENILAIAN
            |--------------------------------------------------------------------------
            | Karena ada unique: [nim, kelas_id, kriteria_id]
            | maka untuk tiap kelas kita pakai 3 mahasiswa berbeda.
            |--------------------------------------------------------------------------
            */
            $mahasiswa = [
                ['nama' => 'Mahasiswa 1', 'nim' => '230001'],
                ['nama' => 'Mahasiswa 2', 'nim' => '230002'],
                ['nama' => 'Mahasiswa 3', 'nim' => '230003'],
            ];
            $penilaianData = [];

            foreach ($nilaiManual as $altKey => $kriteriaList) {
                $kelasId = $kelasIds[$altKey];

                foreach ($kriteriaList as $kodeKriteria => $skorList) {
                    $kriteriaId = $kriteriaIds[$kodeKriteria];

                    foreach ($skorList as $indexMahasiswa => $skor) {
                        $penilaianData[] = [
                            'id' => (string) Str::uuid(),
                            'nama_mahasiswa' => $mahasiswa[$indexMahasiswa]['nama'],
                            'nim' => $mahasiswa[$indexMahasiswa]['nim'],
                            'kelas_id' => $kelasId,
                            'kriteria_id' => $kriteriaId,
                            'skor' => $skor,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                }
            }

            DB::table('penilaian')->insert($penilaianData);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            throw $e;
        }
    }
}
