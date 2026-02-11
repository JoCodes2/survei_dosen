<?php

namespace App\Repositories;

use App\Http\Requests\SemesterRequest;

use App\Interfaces\SemesterInterfaces;

use App\Models\semesterModel;
use App\Models\TopikPenelitian;
use App\Traits\HttpResponseTraits;

class SemesterRepositories implements SemesterInterfaces
{
    use HttpResponseTraits;
    protected $Semester;
    public function __construct(semesterModel $Semester)
    {
        $this->Semester = $Semester;
    }

    public function getAllData()
    {
        $data = $this->Semester::all();
        if (!$data) {
            return $this->dataNotFound();
        }
        return $this->success($data);
    }
    public function createData(SemesterRequest $request)
    {
        try {
            $data = new $this->Semester;
            $data->nama_semester = $request->input('nama_semester');
            $data->tahun_akademik = $request->input('tahun_akademik');

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
        $data = $this->Semester::find($id);
        if (!$data) {
            return $this->dataNotFound();
        }
        return $this->success($data);
    }
    public function updateData($id, SemesterRequest $request)
    {
        try {
            $data = $this->Semester::find($id);
            $data->nama_semester = $request->input('nama_semester');
            $data->tahun_akademik = $request->input('tahun_akademik');
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
        $data = $this->Semester::find($id);
        if (!$data) {
            return $this->dataNotFound();
        }
        $data->delete();
        return $this->delete();
    }

    public function toggleActive($id)
    {
        try {
            $data = $this->Semester::find($id);
            if (!$data) {
                return $this->dataNotFound();
            }
            $data->is_active = !$data->is_active;
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
}
