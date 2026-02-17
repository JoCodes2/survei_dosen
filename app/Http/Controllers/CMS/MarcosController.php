<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Services\MarcosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcosController extends Controller
{
    protected $marcosService;

    // Inject Service ke dalam Controller
    public function __construct(MarcosService $marcosService)
    {
        $this->marcosService = $marcosService;
    }

    /**
     * Testing endpoint untuk perhitungan MARCOS
     */
    public function testCalculation(Request $request)
    {
        // Validasi input untuk memastikan parameter lengkap
        $validator = Validator::make($request->all(), [
            'prodi_id' => 'required|uuid',
            'semester_id' => 'required|uuid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $hasil = $this->marcosService->calculateMarcos(
                $request->prodi_id,
                $request->semester_id,
            );

            if (empty($hasil)) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data tidak ditemukan atau belum ada penilaian untuk kelas tersebut',
                    'data' => []
                ], 200);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Perhitungan MARCOS berhasil',
                'data' => $hasil
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
