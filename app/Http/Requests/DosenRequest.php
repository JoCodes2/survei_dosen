<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DosenRequest extends FormRequest
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
            'nidn' => $isUpdate
                ? 'required|string|max:20'
                : 'required|string|max:20|unique:dosen,nidn',
            'nama_lengkap' => 'required|string|max:255',
            'email' => $isUpdate
            ? 'required|email|max:255'
            : 'required|email|max:255|unique:dosen,email',
            'jabatan_fungsional' => 'nullable|string|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nidn.required' => 'NIDN wajib diisi.',
            'nidn.unique' => 'NIDN sudah terdaftar.',
            'nidn.max' => 'NIDN maksimal 20 karakter.',

            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.max' => 'Nama lengkap maksimal 255 karakter.',


            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',

            'jabatan_fungsional.max' => 'Jabatan fungsional maksimal 100 karakter.',
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
