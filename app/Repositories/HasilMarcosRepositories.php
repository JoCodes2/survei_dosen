<?php

namespace App\Repositories;

use App\Interfaces\MarcosInterfaces;
use App\Models\DosenModel;
use App\Models\HasilModel;
use App\Traits\HttpResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class HasilMarcosRepositories implements MarcosInterfaces
{
    use HttpResponseTraits;
    protected $hasil;
    protected $dosen;
    public function __construct(HasilModel $hasil, DosenModel $dosen)
    {
        $this->hasil = $hasil;
        $this->dosen = $dosen;
    }
    public function getAllData()
    {
        $data = $this->hasil::with(['dosen', 'semester', 'program_studi'])->get();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }
        return $this->success($data);
    }
    public function createData(Request $request)
    {
        try {
            DB::beginTransaction();

            foreach ($request->data_ranking as $index => $item) {
                $dosen = $this->dosen::where('nama_lengkap', $item['dosen'])->first();
                $this->hasil::create([
                    'id' => Str::uuid(),
                    'semester_id' => $request->semester_id,
                    'program_studi_id' => $request->program_studi_id,
                    'dosen_id' => $dosen->id,

                    'nilai_akhir_f' => $item['F(Ki)'],
                    'peringkat' => $index + 1,
                    'nilai_si_ideal' => $item['K+'],
                    'nilai_si_buruk' => $item['K-'],
                ]);
            }

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'History berhasil disimpan'], 200);
        } catch (\Throwable $th) {
            return $this->error(
                $th->getMessage(),
                400,
                $th,
                class_basename($this),
                __FUNCTION__
            );
        }
    }
}
