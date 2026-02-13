<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenilaianModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'penilaian';
    protected $fillable = [
        'id',
        'nama_mahasiswa',
        'nim',
        'kelas_id',
        'kriteria_id',
        'skor',
        'created_at',
        'updated_at'
    ];

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(KriteriaModel::class, 'kriteria_id');
    }
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(JadwalPengampuModel::class, 'kelas_id');
    }
}
