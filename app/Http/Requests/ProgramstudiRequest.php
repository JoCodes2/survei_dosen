<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProgramstudiRequest extends FormRequest
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
            'kode_prodi' => $isUpdate
                ? 'required|string|max:10'
                : 'required|string|max:10|unique:program_studi,kode_prodi',

            'nama_prodi' => 'required|string|max:150',

        ];
    }


    public function messages(): array
    {
        return [
            'kode_prodi.required' => 'Kode prodi wajib diisi.',
            'kode_prodi.unique'   => 'Kode prodi sudah terdaftar.',
            'kode_prodi.max'      => 'Kode prodi maksimal 10 karakter.',

            'nama_prodi.required' => 'Nama program studi wajib diisi.',
            'nama_prodi.max'      => 'Nama program studi maksimal 150 karakter.',

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
