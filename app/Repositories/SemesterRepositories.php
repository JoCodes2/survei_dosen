<?php

namespace App\Repositories;

use App\Http\Requests\SemesterRequest;

use App\Interfaces\SemesterInterfaces;
use App\Models\semesterModel;
use App\Traits\HttpResponseTraits;

class SemesterRepositories implements SemesterInterfaces
{
    use HttpResponseTraits;
    protected $semester;
    public function __construct(semesterModel $semester)
    {
        $this->semester = $semester;
    }

    public function getAllData()
    {
        $data = $this->semester::all();
        if (!$data) {
            return $this->dataNotFound();
        }
        return $this->success($data);
    }
    public function createData(SemesterRequest $request)
    {
        try {
            $data = new $this->semester;
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
        $data = $this->semester::find($id);
        if (!$data) {
            return $this->dataNotFound();
        }
        return $this->success($data);
    }
    public function updateData($id, SemesterRequest $request)
    {
        try {
            $data = $this->semester::find($id);
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
        $data = $this->semester::find($id);
        if (!$data) {
            return $this->dataNotFound();
        }
        $data->delete();
        return $this->delete();
    }

    public function toggleActive($id)
    {
        try {
            $data = $this->semester::find($id);
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
