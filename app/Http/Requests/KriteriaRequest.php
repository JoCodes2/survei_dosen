<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class KriteriaRequest extends FormRequest
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
        $isUpdate = $this->route('id') !== null;

        return [
            'kode_kriteria' => $isUpdate
                ? 'required|string|max:10'
                : 'required|string|max:10|unique:kriteria,kode_kriteria',

            'nama_kriteria' => 'required|string|max:100',

            'bobot' => 'required|numeric|min:0',

            'jenis' => 'required|in:benefit,cost',
        ];
    }


    public function messages(): array
    {
        return [
            'kode_kriteria.required' => 'Kode kriteria wajib diisi.',
            'kode_kriteria.unique'   => 'Kode kriteria sudah digunakan.',
            'kode_kriteria.max'      => 'Kode kriteria maksimal 10 karakter.',

            'nama_kriteria.required' => 'Nama kriteria wajib diisi.',
            'nama_kriteria.max'      => 'Nama kriteria maksimal 100 karakter.',

            'bobot.required' => 'Bobot wajib diisi.',
            'bobot.numeric'  => 'Bobot harus berupa angka.',
            'bobot.min'      => 'Bobot tidak boleh bernilai negatif.',

            'jenis.required' => 'Jenis kriteria wajib dipilih.',
            'jenis.in'       => 'Jenis kriteria harus bernilai benefit atau cost.',
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
