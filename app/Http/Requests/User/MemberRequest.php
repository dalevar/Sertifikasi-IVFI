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
            'gender' => 'required|in:L,P',
            'address' => 'required|max:255',
            'phone' => 'required|min:10|max:13',
            'email' => 'required|email'
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Nama Lengkap Wajib Diisi',
            'fullname.string' => 'Nama Lengkap Harus Berupa Huruf',

            'number_identity.required' => 'Nomor Identitas Wajib Diisi',
            'number_identity.unique' => 'Nomor Identitas Sudah Terdaftar',

            'birthplace.required' => 'Tempat Lahir Wajib Diisi',
            'birthplace.string' => 'Tempat Lahir Harus Berupa Huruf',

            'birthday.required' => 'Tanggal Lahir Wajib Diisi',
            'birthday.date' => 'Tanggal Lahir Harus Berupa Tanggal',

            'gender.required' => 'Jenis Kelamin Wajib Diisi',

            'address.required' => 'Alamat Wajib Diisi',
            
            'phone.required' => 'No. Telepon/HP Wajib Diisi',
            'phone.min'      => 'No. Telepon/HP Minimal 10 Karakter',
            'phone.max'      => 'No. Telepon/HP Maksimal 13 Karakter',

            'email.required' => 'Email Wajib Diisi',
        ];
    }
}
