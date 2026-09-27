<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiRequest extends FormRequest
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
            'id_pelanggan'    => ['nullable', 'exists:pelanggan,id_pelanggan'],
            'metode_bayar'    => ['required', 'in:Tunai,QRIS,Transfer,Debit'],
            'items'           => ['required', 'array', 'min:1'],
            'items.*.id_menu' => ['required', 'exists:menu,id_menu'],
            'items.*.jumlah'  => ['required', 'integer', 'min:1'],
        ];
    }
}
