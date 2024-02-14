<?php

namespace App\Rules;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\RegistroFactura;

class num_factura implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regstroFactura = RegistroFactura::select('num_factura')->where([
            ['num_factura', $value],
            ['estado_id', '!=', 0]
        ])->first();

        if ($regstroFactura){
            $fail('Oops, este número de factura ya fué registrado.'); 
        }
    }
}
