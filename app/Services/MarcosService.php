<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class MarcosService
{
    /**
     * Menghitung metode MARCOS berdasarkan Prodi dan Semester.
     *
     * @param string $prodiId
     * @param string $semesterId
     * @return array
     */
    public function calculateMarcos($prodiId, $semesterId)
    {
        $kriteria = DB::table('kriteria')
            ->orderBy('kode_kriteria')
            ->get();

        if ($kriteria->isEmpty()) {
            return [];
        }

        $w = $kriteria->pluck('bobot')->toArray();

        $kelasIds = DB::table('kelas')
            ->where('program_studi_id', $prodiId)
            ->where('semester_id', $semesterId)
            ->pluck('id')
            ->toArray();

        if (empty($kelasIds)) {
            return [];
        }

        $alternatif = DB::table('dosen')
            ->join('kelas', 'dosen.id', '=', 'kelas.dosen_id')
            ->whereIn('kelas.id', $kelasIds)
            ->select('dosen.id', 'dosen.nama_lengkap')
            ->distinct()
            ->get();

        if ($alternatif->isEmpty()) {
            return [];
        }

        $matriksKeputusan = [];
        foreach ($alternatif as $alt) {
            $row = [];
            foreach ($kriteria as $krit) {
                $rataSkor = DB::table('penilaian')
                    ->join('kelas', 'penilaian.kelas_id', '=', 'kelas.id')
                    ->whereIn('kelas.id', $kelasIds)
                    ->where('kelas.dosen_id', $alt->id)
                    ->where('penilaian.kriteria_id', $krit->id)
                    ->avg('penilaian.skor');

                $row[] = $rataSkor ?? 0;
            }
            $matriksKeputusan[$alt->id] = $row;
        }

        $AI = [];
        $AAI = [];
        for ($j = 0; $j < count($kriteria); $j++) {
            $kolomSkor = array_column($matriksKeputusan, $j);
            if ($kriteria[$j]->jenis == 'benefit') {
                $AAI[$j] = max($kolomSkor);
                $AI[$j] = min($kolomSkor);
            } else {
                $AAI[$j] = min($kolomSkor);
                $AI[$j] = max($kolomSkor);
            }
        }

        // 6. Normalisasi
        $normalisasi = [];
        foreach ($matriksKeputusan as $altId => $skorAlt) {
            $rowNorm = [];
            foreach ($skorAlt as $j => $skor) {
                if ($kriteria[$j]->jenis == 'benefit') {
                    $rowNorm[] = $AAI[$j] != 0 ? $skor / $AAI[$j] : 0;
                } else {
                    $rowNorm[] = $skor != 0 ? $AI[$j] / $skor : 0;
                }
            }
            $normalisasi[$altId] = $rowNorm;
        }

        // 7. Matriks Bobot
        $matriksBobot = [];
        foreach ($normalisasi as $altId => $skorNorm) {
            $rowBobot = [];
            foreach ($skorNorm as $j => $skor) {
                $rowBobot[] = $skor * $w[$j];
            }
            $matriksBobot[$altId] = $rowBobot;
        }

        // 8. Hitung Si (Nilai Total Alternatif)
        $Si = [];
        foreach ($matriksBobot as $altId => $skorBobot) {
            $Si[$altId] = array_sum($skorBobot);
        }

        // 9. Hitung Utilitas (Ki+ dan Ki-)
        $minSi = min($Si);
        $maxSi = max($Si);
        $result = [];
        foreach ($alternatif as $alt) {
            $s = $Si[$alt->id];
            $kMinus = $maxSi != 0 ? $s / $maxSi : 0;
            $kPlus = $minSi != 0 ? $s / $minSi : 0;
            $fKi = ($kMinus + $kPlus) / 2;

            // --- PERUBAHAN DI SINI: Gunakan round(..., 2) ---
            $result[] = [
                'dosen' => $alt->nama_lengkap,
                'Si' => round($s, 2),
                'K-' => round($kMinus, 2),
                'K+' => round($kPlus, 2),
                'F(Ki)' => round($fKi, 2),
            ];
        }

        // 10. Perankingan
        usort($result, function ($a, $b) {
            return $b['F(Ki)'] <=> $a['F(Ki)'];
        });

        return $result;
    }
}
