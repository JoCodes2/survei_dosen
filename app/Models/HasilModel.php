<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilModel extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'history_penilaian';
    protected $fillable = [
        'id',
        'semester_id',
        'program_studi_id',
        'dosen_id',
        'nilai_akhir_f',
        'peringkat',
        'nilai_si_ideal',
        'nilai_si_buruk',
        'created_at',
        'updated_at'
    ];
    public function semester(): BelongsTo
    {
        return $this->belongsTo(semesterModel::class, 'semester_id', 'id');
    }
    public function program_studi(): BelongsTo
    {
        return $this->belongsTo(ProgramstudiModel::class, 'program_studi_id', 'id');
    }
    public function dosen(): BelongsTo
    {
        return $this->belongsTo(DosenModel::class, 'dosen_id', 'id');
    }
}
