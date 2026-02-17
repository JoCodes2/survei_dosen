<?php

namespace App\Http\Requests;

use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str; // Import Str

class PenilaianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // --- REVISI VALIDASI NAMA ---
            'nama_mahasiswa' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $nim = $this->input('nim');
                    if (!$nim) return;

                    $existingSurvey = PenilaianModel::where('nim', $nim)->first();

                    if ($existingSurvey) {
                        if (Str::lower(trim($existingSurvey->nama_mahasiswa)) !== Str::lower(trim($value))) {
                            $fail('Nama mahasiswa tidak sesuai dengan survei sebelumnya untuk NIM ' . $nim . '. (Terdaftar: ' . $existingSurvey->nama_mahasiswa . ')');
                        }
                    }
                },
            ],
            // ---------------------------------
            'nim'            => 'required|string|max:20',
            'kelas_id'       => [
                'required',
                'uuid',
                'exists:kelas,id',
                function ($attribute, $value, $fail) {
                    $nim = $this->input('nim');
                    $exists = PenilaianModel::where('nim', $nim)
                        ->where('kelas_id', $value)
                        ->exists();

                    if ($exists) {
                        $fail('Anda sudah pernah melakukan survei untuk dosen ini pada semester ini.');
                    }
                },
            ],
            'skor_kriteria'            => 'required|array',
            'skor_kriteria.*'          => 'required|integer|min:1|max:5',
            'skor_kriteria' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    $kriteriaCount = KriteriaModel::count();
                    if (count($value) !== $kriteriaCount) {
                        $fail('Semua kriteria wajib diisi.');
                    }
                },
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'code'    => 422,
                'status'  => 'validation_failed',
                'message' => 'Check your input data',
                'data'    => $validator->errors(),
            ], 422)
        );
    }
}
