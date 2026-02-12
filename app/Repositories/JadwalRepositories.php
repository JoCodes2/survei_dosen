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
        $data = $this->jadwalPengampu::all();
        if (!$data) {
            return $this->dataNotFound();
        }
        return $this->success($data);
    }
    public function createData(JadwalPengampuRequest $request)
    {
        try {
            $data = new $this->jadwalPengampu;
            $data->dosen_id = $request->dosen_id;
            $data->program_studi_id = $request->program_studi_id;
            $data->semester_id = $request->semester_id;
            $data->kode_mk = $request->kode_mk;
            $data->nama_matakuliah = $request->nama_matakuliah;
            $data->kelas = $request->kelas;
            $data->save();
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
        $data = $this->jadwalPengampu::find($id);
        if (!$data) {
            return $this->idOrDataNotFound();
        }
        return $this->success($data);
    }
    public function updateData(JadwalPengampuRequest $request, $id)
    {
        try {
            $data = $this->jadwalPengampu::find($id);
            $data->dosen_id = $request->dosen_id;
            $data->program_studi_id = $request->program_studi_id;
            $data->semester_id = $request->semester_id;
            $data->kode_mk = $request->kode_mk;
            $data->nama_matakuliah = $request->nama_matakuliah;
            $data->kelas = $request->kelas;
            $data->save();
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
