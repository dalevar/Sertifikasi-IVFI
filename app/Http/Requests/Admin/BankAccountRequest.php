<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BankAccountRequest extends FormRequest
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
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:125',
            'account_holder' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'bank_name.required' => 'Nama Bank Wajib Diisi',
            'account_number.required' => 'Nomor Rekening Wajib Diisi',
            'account_holder.required' => 'Nama Pemilik Rekening Wajib Diisi',
        ];
    }
}
