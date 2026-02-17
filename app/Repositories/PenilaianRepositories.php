<?php

namespace App\Repositories;

use App\Http\Requests\PenilaianRequest;
use App\Interfaces\PenilaianInterfaces;
use App\Models\PenilaianModel;
use App\Traits\HttpResponseTraits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PenilaianRepositories implements PenilaianInterfaces
{
    use HttpResponseTraits;
    protected $penilaianDosen;

    public function __construct(PenilaianModel $penilaianDosen)
    {
        $this->penilaianDosen = $penilaianDosen;
    }

    public function getAllData()
    {
        $data = $this->penilaianDosen->with([
            'kriteria',
            'kelas.dosen'
        ])->get();

        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }

        return $this->success($data);
    }

    public function createData(PenilaianRequest $request)
    {
        try {
            DB::beginTransaction();

            $dataRequest = $request->validated();
            $surveiItems = [];

            foreach ($dataRequest['skor_kriteria'] as $kriteriaId => $skor) {
                $surveiItems[] = [
                    'id'             => (string) Str::uuid(),
                    'nama_mahasiswa' => $dataRequest['nama_mahasiswa'],
                    'nim'            => $dataRequest['nim'],
                    'kelas_id'       => $dataRequest['kelas_id'],
                    'kriteria_id'    => $kriteriaId,
                    'skor'           => $skor,
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ];
            }

            $this->penilaianDosen->insert($surveiItems);

            DB::commit();
            return $this->success();
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error(
                $th->getMessage(),
                400,
                $th,
                class_basename($this),
                __FUNCTION__
            );
        }
    }

    public function getDataById($id)
    {
        $data = $this->penilaianDosen->with(['kriteria', 'kelas'])->find($id);

        if (!$data) {
            return $this->idOrDataNotFound();
        }
        return $this->success($data);
    }

    public function updateData(PenilaianRequest $request, $id)
    {
        try {
            $data = $this->penilaianDosen->find($id);
            if (!$data) {
                return $this->idOrDataNotFound();
            }

            $data->update($request->validated());

            return $this->success($data, 'Data penilaian berhasil diupdate');
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

    public function deleteData($id)
    {
        $data = $this->penilaianDosen->find($id);

        if (!$data) {
            return $this->idOrDataNotFound();
        }

        $data->delete();
        return $this->success(null, 'Data berhasil dihapus');
    }
}
