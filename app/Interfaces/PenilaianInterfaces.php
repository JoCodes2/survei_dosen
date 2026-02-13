<?php

namespace App\Interfaces;

use App\Http\Requests\PenilaianRequest;

interface PenilaianInterfaces
{
    public function getAllData();
    public function createData(PenilaianRequest $request);
    public function updateData(PenilaianRequest $request, $id);
    public function deleteData($id);
    public function getDataById($id);
}
