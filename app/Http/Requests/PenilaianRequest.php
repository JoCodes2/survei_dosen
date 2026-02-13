<?php
// app/Http/Requests/PenilaianRequest.php

namespace App\Http\Requests;

use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PenilaianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_mahasiswa' => 'required|string|max:255',
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
                        $fail('Anda sudah pernah melakukan survei untuk kelas ini.');
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
