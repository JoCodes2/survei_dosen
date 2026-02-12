<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class semesterModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'semester';

    protected $fillable = [
        'id',
        'nama_semester',
        'tahun_akademik',
        'is_active',
        'created_at',
        'updated_at'
    ];


}
