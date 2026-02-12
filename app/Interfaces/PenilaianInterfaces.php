<?php

namespace App\Interfaces;

interface PenilaianInterfaces
{
    public function getAllData();
    public function getDataPenilaian($semesterId, $programStudiId);
    public function simpanPenilaian($data);
}
