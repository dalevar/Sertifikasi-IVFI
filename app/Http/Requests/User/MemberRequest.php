<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'fullname' => 'required|string|max:255',
            'number_identity' => 'required|string|unique:members,number_identity',
            'birthplace' => 'required|string|max:255',
            'birthday' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Nama Lenkap Wajib Diisi',
            'fullname.string' => 'Nama Lengkap Harus Berupa Huruf',

            'number_identity.required' => 'Nomor Identitas Wajib Diisi',
            'number_identity.unique' => 'Nomor Identitas Sudah Terdaftar',

            'birthplace.required' => 'Tempat Lahir Wajib Diisi',
            'birthplace.string' => 'Tempat Lahir Harus Berupa Huruf',

            'birthday.required' => 'Tanggal Lahir Wajib Diisi',
            'birthday.date' => 'Tanggal Lahir Harus Berupa Tanggal',


        ];
    }
}
