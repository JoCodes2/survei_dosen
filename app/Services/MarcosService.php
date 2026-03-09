<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class MarcosService
{
    private function r2($value)
    {
        return round((float) $value, 2);
    }

    public function calculateMarcos($prodiId, $semesterId)
    {
        $kriteria = DB::table('kriteria')
            ->orderBy('kode_kriteria')
            ->get();

        if ($kriteria->isEmpty()) {
            return [];
        }

        $jumlahKriteria = $kriteria->count();
        $bobot = $kriteria->pluck('bobot')->map(function ($item) {
            return round((float) $item, 2);
        })->toArray();

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

        // 1. Matriks keputusan (dibulatkan 2 desimal)
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

                $row[] = $this->r2($rataSkor ?? 0);
            }

            $matriksKeputusan[$alt->id] = $row;
        }

        // 2. AI dan AAI
        $AI = [];
        $AAI = [];

        for ($j = 0; $j < $jumlahKriteria; $j++) {
            $kolomSkor = array_column($matriksKeputusan, $j);

            if (($kriteria[$j]->jenis ?? 'benefit') === 'benefit') {
                $AI[$j] = $this->r2(max($kolomSkor));
                $AAI[$j] = $this->r2(min($kolomSkor));
            } else {
                $AI[$j] = $this->r2(min($kolomSkor));
                $AAI[$j] = $this->r2(max($kolomSkor));
            }
        }

        // 3. SAAI
        $SAAI = 0.0;
        for ($j = 0; $j < $jumlahKriteria; $j++) {
            if (($kriteria[$j]->jenis ?? 'benefit') === 'benefit') {
                $nilaiAntiIdealNorm = $AI[$j] != 0 ? $this->r2($AAI[$j] / $AI[$j]) : 0;
            } else {
                $nilaiAntiIdealNorm = $AAI[$j] != 0 ? $this->r2($AI[$j] / $AAI[$j]) : 0;
            }

            $SAAI += $this->r2($nilaiAntiIdealNorm * $bobot[$j]);
            $SAAI = $this->r2($SAAI);
        }

        $SAI = $this->r2(array_sum($bobot));

        // 4. Normalisasi alternatif
        $normalisasi = [];
        foreach ($matriksKeputusan as $altId => $skorAlt) {
            $rowNorm = [];

            foreach ($skorAlt as $j => $skor) {
                if (($kriteria[$j]->jenis ?? 'benefit') === 'benefit') {
                    $rowNorm[] = $AI[$j] != 0 ? $this->r2($skor / $AI[$j]) : 0.0;
                } else {
                    $rowNorm[] = $skor != 0 ? $this->r2($AI[$j] / $skor) : 0.0;
                }
            }

            $normalisasi[$altId] = $rowNorm;
        }

        // 5. Matriks bobot dan Si
        $Si = [];
        foreach ($normalisasi as $altId => $rowNorm) {
            $total = 0.0;

            foreach ($rowNorm as $j => $nilaiNorm) {
                $nilaiBobot = $this->r2($nilaiNorm * $bobot[$j]);
                $total += $nilaiBobot;
                $total = $this->r2($total);
            }

            $Si[$altId] = $this->r2($total);
        }

        // 6. Hitung utilitas
        $result = [];
        foreach ($alternatif as $alt) {
            $s = $Si[$alt->id] ?? 0.0;

            $kMinus = $SAAI != 0 ? $this->r2($s / $SAAI) : 0.0;
            $kPlus  = $SAI != 0 ? $this->r2($s / $SAI) : 0.0;
            $fKi    = $this->r2(($kMinus + $kPlus) / 2);

            $result[] = [
                'dosen' => $alt->nama_lengkap,
                'Si' => $this->r2($s),
                'K-' => $kMinus,
                'K+' => $kPlus,
                'F(Ki)' => $fKi,
            ];
        }

        usort($result, function ($a, $b) {
            return $b['F(Ki)'] <=> $a['F(Ki)'];
        });

        foreach ($result as $index => &$item) {
            $item['ranking'] = $index + 1;
        }

        return $result;
    }
}
