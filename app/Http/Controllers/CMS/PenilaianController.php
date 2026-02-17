<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenilaianRequest;
use App\Repositories\PenilaianRepositories;

class PenilaianController extends Controller
{
    protected $surveiRepo;

    public function __construct(PenilaianRepositories $surveiRepo)
    {
        $this->surveiRepo = $surveiRepo;
    }
    public function getAllData()
    {
        return $this->surveiRepo->getAllData();
    }
    public function createData(PenilaianRequest $request)
    {
        return $this->surveiRepo->createData($request);
    }
    public function getDataById($id)
    {
        return $this->surveiRepo->getDataById($id);
    }
    public function updateData(PenilaianRequest $request, $id)
    {
        return $this->surveiRepo->updateData($request, $id);
    }
    public function deleteData($id)
    {
        return $this->surveiRepo->deleteData($id);
    }
}
