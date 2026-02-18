<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\HasilModel;
use App\Repositories\HasilMarcosRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilMarcos extends Controller
{
    protected $hasilRepo;
    public function __construct(HasilMarcosRepositories $hasilRepo)
    {
        $this->hasilRepo = $hasilRepo;
    }
    public function getAllData()
    {
        return $this->hasilRepo->getAllData();
    }
    public function createData(Request $request)
    {
        return $this->hasilRepo->createData($request);
    }
    public function getTopDosen()
    {
        $topDosen = HasilModel::select('dosen_id', DB::raw('AVG(nilai_akhir_f) as rata_rata'))
            ->with('dosen')
            ->groupBy('dosen_id')
            ->orderBy('rata_rata', 'desc')
            ->limit(10)
            ->get();

        return response()->json([
            'code' => 200,
            'data' => $topDosen
        ]);
    }
}
