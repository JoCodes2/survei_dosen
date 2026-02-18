<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface MarcosInterfaces
{
    public function getAllData();
    public function createData(Request $request);
}
