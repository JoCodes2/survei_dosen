<?php

namespace App\Interfaces;

use App\Http\Requests\ProgramstudiRequest;

interface ProgramstudiInterfaces
{
    public function getAllData();
    public function createData(ProgramstudiRequest $request);
    public function getDataById($id);
    public function updateData($id, ProgramstudiRequest $request);
    public function deleteData($id);
}
