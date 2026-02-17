<?php

namespace App\Interfaces;

use App\Http\Requests\JadwalPengampuRequest;

interface JadwalPengampuInterfaces
{
    public function getAllData();
    public function createData(JadwalPengampuRequest $request);
    public function getDataById($id);
    public function updateData(JadwalPengampuRequest $request, $id);
    public function deleteData($id);
}
