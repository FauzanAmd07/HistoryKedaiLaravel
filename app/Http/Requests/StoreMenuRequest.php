<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'id_kategori'  => ['required', 'exists:kategori,id_kategori'],
            'nama_menu'    => ['required', 'string', 'max:255'],
            'harga'        => ['required', 'numeric', 'min:0'],
            'gambar'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'deskripsi'    => ['nullable', 'string'],
            'status_menu'  => ['required', 'in:Tersedia,Habis'],
        ];
    }

    /**
     * Custom message for validation errors.
     */
    public function messages(): array
    {
        return [
            'id_kategori.required' => 'Kategori menu wajib dipilih.',
            'id_kategori.exists'   => 'Kategori yang dipilih tidak valid.',
            'nama_menu.required'   => 'Nama menu wajib diisi.',
            'harga.required'       => 'Harga menu wajib diisi.',
            'harga.numeric'        => 'Harga menu harus berupa angka.',
            'gambar.image'         => 'File gambar harus berupa citra gambar.',
            'status_menu.required' => 'Status menu wajib dipilih.',
        ];
    }
}
