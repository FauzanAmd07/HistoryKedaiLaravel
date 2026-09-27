<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKaryawanRequest extends FormRequest
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
        $karyawanId = $this->route('karyawan') ? $this->route('karyawan')->id_karyawan : null;

        return [
            'nama'     => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username,' . $karyawanId . ',id_karyawan'],
            'jabatan'  => ['required', 'in:Pemilik,Admin,Kasir'],
            'password' => ['nullable', 'string', 'min:6'],
        ];
    }
}
