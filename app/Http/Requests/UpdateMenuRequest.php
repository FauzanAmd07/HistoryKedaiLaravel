<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'id_kategori'  => ['sometimes', 'required', 'exists:kategori,id_kategori'],
            'nama_menu'    => ['sometimes', 'required', 'string', 'max:255'],
            'harga'        => ['sometimes', 'required', 'numeric', 'min:0'],
            'gambar'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'deskripsi'    => ['nullable', 'string'],
            'status_menu'  => ['sometimes', 'required', 'in:Tersedia,Habis'],
        ];
    }
}
