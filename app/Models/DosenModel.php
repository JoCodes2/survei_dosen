<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DosenModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'dosen';

    protected $fillable = [
        'id',
        'nidn',
        'nama_lengkap',
        'email',
        'jabatan_fungsional',
        'created_at',
        'updated_at'
    ];
}
