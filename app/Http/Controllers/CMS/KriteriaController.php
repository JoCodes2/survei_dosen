<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\KriteriaRequest;
use App\Repositories\KriteriaRepositories;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    protected $Kriteria;

    public function __construct(KriteriaRepositories $Kriteria)
    {
        $this->Kriteria = $Kriteria;
    }
    public function getAllData()
    {
        return $this->Kriteria->getAllData();
    }
    public function createData(KriteriaRequest $request)
    {
        return $this->Kriteria->createData($request);
    }
    public function getDataById($id)
    {
        return $this->Kriteria->getDataById($id);
    }

    public function updateData(KriteriaRequest $request, $id)
    {
        return $this->Kriteria->updateData($id, $request);
    }

    public function deleteData($id)
    {
        return $this->Kriteria->deleteData($id);
    }
}
