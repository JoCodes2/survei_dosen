<?php

namespace App\Repositories;

use App\Http\Requests\ProgramstudiRequest;
use App\Http\Requests\TopikPenelitianRequest;
use App\Interfaces\ProgramstudiInterfaces;
use App\Interfaces\TopikPenelitianInterfaces;
use App\Models\ProgramstudiModel;
use App\Models\TopikPenelitian;
use App\Traits\HttpResponseTraits;

class ProgramstudiRepositories implements ProgramstudiInterfaces
{
    use HttpResponseTraits;
    protected $Programstudi;
    public function __construct(ProgramstudiModel $Programstudi)
    {
        $this->Programstudi = $Programstudi;
    }

    public function getAllData()
    {
        $data = $this->Programstudi::all();
        if (!$data) {
            return $this->dataNotFound();
        }
        return $this->success($data);
    }
    public function createData(ProgramstudiRequest $request)
    {
        try {
            $data = new $this->Programstudi;
            $data->kode_prodi = $request->input('kode_prodi');
            $data->nama_prodi = $request->input('nama_prodi');

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
        $data = $this->Programstudi::find($id);
        if (!$data) {
            return $this->dataNotFound();
        }
        return $this->success($data);
    }
    public function updateData($id, ProgramstudiRequest $request)
    {
        try {
            $data = $this->Programstudi::find($id);
            $data->kode_prodi = $request->input('kode_prodi');
            $data->nama_prodi = $request->input('nama_prodi');
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
        $data = $this->Programstudi::find($id);
        if (!$data) {
            return $this->dataNotFound();
        }
        $data->delete();
        return $this->delete();
    }
}
