<?php

namespace App\Interfaces;

use App\Http\Requests\SemesterRequest;

interface SemesterInterfaces
{
    public function getAllData();
    public function createData(SemesterRequest $request);
    public function getDataById($id);
    public function updateData($id, SemesterRequest $request);
    public function deleteData($id);
}
