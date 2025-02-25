<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CertificationRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul Jenis Sertifikasi Wajib Diisi',
            'description.required' => 'Deskripsi Wajib Diisi',
            'price.required' => 'Harga Wajib Diisi',
            'price.integer' => 'Harga hanya boleh angka',
        ];
    }
}
