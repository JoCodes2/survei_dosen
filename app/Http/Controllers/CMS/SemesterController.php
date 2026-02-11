<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\SemesterRequest;
use App\Repositories\SemesterRepositories;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    protected $Semester;

    public function __construct(SemesterRepositories $Semester)
    {
        $this->Semester = $Semester;
    }
    public function getAllData()
    {
        return $this->Semester->getAllData();
    }
    public function createData(SemesterRequest $request)
    {
        return $this->Semester->createData($request);
    }
    public function getDataById($id)
    {
        return $this->Semester->getDataById($id);
    }

    public function updateData(SemesterRequest $request, $id)
    {
        return $this->Semester->updateData($id, $request);
    }

    public function deleteData($id)
    {
        return $this->Semester->deleteData($id);
    }

    public function toggleActive($id)
    {
        return $this->Semester->toggleActive($id);
    }
}
