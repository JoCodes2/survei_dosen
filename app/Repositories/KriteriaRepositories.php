<?php

namespace App\Repositories;

use App\Http\Requests\KriteriaRequest;
use App\Interfaces\KriteriaInterfaces;
use App\Models\KriteriaModel;
use App\Traits\HttpResponseTraits;

class KriteriaRepositories implements KriteriaInterfaces
{
    use HttpResponseTraits;
    protected $KriteriaModel;
    public function __construct(KriteriaModel $KriteriaModel)
    {
        $this->KriteriaModel = $KriteriaModel;
    }

    public function getAllData()
    {
        $data = $this->KriteriaModel::all();
        if (!$data) {
            return $this->dataNotFound();
        }
        return $this->success($data);
    }
    public function createData(KriteriaRequest $request)
    {
        try {
            $data = new $this->KriteriaModel;
            $data->kode_kriteria = $request->input('kode_kriteria');
            $data->nama_kriteria = $request->input('nama_kriteria');
            $data->bobot = $request->input('bobot');
            $data->jenis = $request->input('jenis');
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
        $data = $this->KriteriaModel::find($id);
        if (!$data) {
            return $this->dataNotFound();
        }
        return $this->success($data);
    }
    public function updateData($id, KriteriaRequest $request)
    {
        try {
            $data = $this->KriteriaModel::find($id);
            $data->kode_kriteria = $request->input('kode_kriteria');
            $data->nama_kriteria = $request->input('nama_kriteria');
            $data->bobot = $request->input('bobot');
            $data->jenis = $request->input('jenis');
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
        try {
            $data = $this->KriteriaModel::find($id);
            $data->delete();
            return $this->delete();
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
