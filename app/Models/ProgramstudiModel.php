<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramstudiModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'program_studi';

    protected $fillable = [
        'id',
        'kode_prodi',
        'nama_prodi',
        'created_at',
        'updated_at'
    ];
}
