<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalPengampuRequest;
use App\Repositories\JadwalRepositories;
use Illuminate\Http\Request;

class JadwalPengampuController extends Controller
{
    protected $jadwalRepo;

    public function __construct(JadwalRepositories $jadwalRepo)
    {
        $this->jadwalRepo = $jadwalRepo;
    }
    public function getAllData()
    {
        return $this->jadwalRepo->getAllData();
    }
    public function createData(JadwalPengampuRequest $request)
    {
        return $this->jadwalRepo->createData($request);
    }
    public function getDataById($id)
    {
        return $this->jadwalRepo->getDataById($id);
    }
    public function updateData(JadwalPengampuRequest $request, $id)
    {
        return $this->jadwalRepo->updateData($request, $id);
    }
    public function deleteData($id)
    {
        return $this->jadwalRepo->deleteData($id);
    }
}
