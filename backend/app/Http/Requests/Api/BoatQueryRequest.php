<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BoatQueryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'incluir_inactivos' => ['sometimes', 'boolean'],
            'ordenar_por' => ['sometimes', 'string', Rule::in(['nombre', 'capacidad_pasajeros', 'created_at'])],
            'orden' => ['sometimes', 'string', Rule::in(['asc', 'desc'])],
        ];
    }

    public function messages(): array
    {
        return [
            'ordenar_por.in' => 'Campo de ordenamiento inválido. Valores permitidos: nombre, capacidad_pasajeros, created_at',
            'orden.in' => 'Orden inválido. Valores permitidos: asc, desc',
        ];
    }
}