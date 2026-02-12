<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramstudiRequest;
use App\Repositories\ProgramstudiRepositories;
use Illuminate\Http\Request;

class ProgramstudiController extends Controller
{
    protected $Programstudi;

    public function __construct(ProgramstudiRepositories $Programstudi)
    {
        $this->Programstudi = $Programstudi;
    }
    public function getAllData()
    {
        return $this->Programstudi->getAllData();
    }
    public function createData(ProgramstudiRequest $request)
    {
        return $this->Programstudi->createData($request);
    }
    public function getDataById($id)
    {
        return $this->Programstudi->getDataById($id);
    }

    public function updateData(ProgramstudiRequest $request, $id)
    {
        return $this->Programstudi->updateData($id, $request);
    }

    public function deleteData($id)
    {
        return $this->Programstudi->deleteData($id);
    }
}
