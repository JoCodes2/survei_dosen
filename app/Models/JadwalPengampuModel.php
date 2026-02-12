<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPengampuModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'jadwal_pengampu';
    protected $fillable = [
        'id',
        'dosen_id',
        'program_studi_id',
        'semester_id',
        'kode_mk',
        'nama_matakuliah',
        'kelas',
        'created_at',
        'updated_at',
    ];
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(DosenModel::class, 'dosen_id');
    }
    public function program_studi(): BelongsTo
    {
        return $this->belongsTo(ProgramstudiModel::class, 'program_studi_id');
    }
    public function semester(): BelongsTo
    {
        return $this->belongsTo(SemesterModel::class, 'semester_id');
    }
}
