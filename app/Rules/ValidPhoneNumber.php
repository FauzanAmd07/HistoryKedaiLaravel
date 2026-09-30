<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidPhoneNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^(^\+62|62|^08)(\d{8,11})$/', $value)) {
            $fail('Format nomor telepon Indonesia tidak valid.');
        }
    }
}
