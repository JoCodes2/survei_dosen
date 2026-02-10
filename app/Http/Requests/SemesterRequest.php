<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SemesterRequest extends FormRequest
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
            'nama_semester' => 'required|string|max:20',

            'tahun_akademik' => [
                'required',
                'string',
            ],

        ];
    }



    public function messages(): array
    {
        return [
            'nama_semester.required' => 'Nama semester wajib diisi.',
            'nama_semester.max'      => 'Nama semester maksimal 20 karakter.',

            'tahun_akademik.required' => 'Tahun akademik wajib diisi.',

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
