<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\ItineraryType;

class DepartureQueryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $validTypes = array_column(ItineraryType::cases(), 'value');

        return [
            'barco_id' => ['sometimes', 'integer', 'exists:boats,id'],
            'itinerario_tipo' => ['sometimes', 'string', Rule::in($validTypes)],
            'fecha_desde' => ['sometimes', 'date'],
            'fecha_hasta' => ['sometimes', 'date', 'after:fecha_desde'],
            'disponibles' => ['sometimes', 'boolean'],
            'ordenar_por' => ['sometimes', 'string', Rule::in(['fecha_salida', 'created_at'])],
            'orden' => ['sometimes', 'string', Rule::in(['asc', 'desc'])],
            'limite' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'barco_id.integer' => 'El ID del barco debe ser un número entero',
            'barco_id.exists' => 'El barco especificado no existe',
            'itinerario_tipo.in' => 'Tipo de itinerario inválido. Valores permitidos: 4D/3N, 5D/4N, 8D/7N',
            'fecha_desde.date' => 'La fecha de inicio debe ser una fecha válida',
            'fecha_hasta.date' => 'La fecha de fin debe ser una fecha válida',
            'fecha_hasta.after' => 'La fecha de fin debe ser posterior a la fecha de inicio',
            'limite.integer' => 'El límite debe ser un número entero',
            'limite.min' => 'El límite mínimo es 1',
            'limite.max' => 'El límite máximo es 100',
            'ordenar_por.in' => 'Campo de ordenamiento inválido',
            'orden.in' => 'Orden inválido. Valores permitidos: asc, desc',
        ];
    }
}