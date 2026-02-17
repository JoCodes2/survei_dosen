<?php

namespace App\Repositories;

use App\Http\Requests\JadwalPengampuRequest;
use App\Interfaces\JadwalPengampuInterfaces;
use App\Models\JadwalPengampuModel;
use App\Traits\HttpResponseTraits;

class JadwalRepositories implements JadwalPengampuInterfaces
{
    use HttpResponseTraits;
    protected $jadwalPengampu;
    public function __construct(JadwalPengampuModel $jadwalPengampu)
    {
        $this->jadwalPengampu = $jadwalPengampu;
    }

    public function getAllData()
    {
        $data = $this->jadwalPengampu
            ->with(['dosen', 'program_studi', 'semester'])
            ->get();

        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }

        return $this->success($data);
    }

    public function createData(JadwalPengampuRequest $request)
    {
        try {
            $exists = $this->jadwalPengampu->where('dosen_id', $request->dosen_id)
                ->where('program_studi_id', $request->program_studi_id)
                ->where('semester_id', $request->semester_id)
                ->exists();

            if ($exists) {
                return $this->error(
                    'Data dosen untuk program studi dan semester tersebut sudah ada.',
                    409,
                    null,
                    class_basename($this),
                    __FUNCTION__
                );
            }

            $data = new $this->jadwalPengampu;
            $data->dosen_id = $request->dosen_id;
            $data->program_studi_id = $request->program_studi_id;
            $data->semester_id = $request->semester_id;
            $data->save();

            return $this->success($data);
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
    public function getDataById($id)
    {
        $data = $this->jadwalPengampu::with(['dosen', 'program_studi', 'semester'])->find($id);
        if (!$data) {
            return $this->idOrDataNotFound();
        }
        return $this->success($data);
    }
    public function updateData(JadwalPengampuRequest $request, $id)
    {
        try {
            // 1. Cek apakah ada data LAIN yang memiliki kombinasi yang sama
            $exists = $this->jadwalPengampu->where('dosen_id', $request->dosen_id)
                ->where('program_studi_id', $request->program_studi_id)
                ->where('semester_id', $request->semester_id)
                ->where('id', '!=', $id) // PENTING: Kecualikan data yang sedang diedit
                ->exists();

            if ($exists) {
                return $this->error(
                    'Data dosen untuk program studi dan semester tersebut sudah ada pada data lain.',
                    409,
                    null,
                    class_basename($this),
                    __FUNCTION__
                );
            }

            // 2. Cari data berdasarkan ID
            $data = $this->jadwalPengampu->findOrFail($id);
            $data->dosen_id = $request->dosen_id;
            $data->program_studi_id = $request->program_studi_id;
            $data->semester_id = $request->semester_id;
            $data->save();

            return $this->success($data);
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
        $data = $this->jadwalPengampu::find($id);
        if (!$data) {
            return $this->idOrDataNotFound();
        }
        $data->delete();
        return $this->delete();
    }
}
