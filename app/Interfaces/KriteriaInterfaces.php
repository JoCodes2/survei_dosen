<?php

namespace App\Interfaces;

use App\Http\Requests\KriteriaRequest;

interface KriteriaInterfaces
{
    public function getAllData();
    public function createData(KriteriaRequest $request);
    public function getDataById($id);
    public function updateData($id, KriteriaRequest $request);
    public function deleteData($id);
}
