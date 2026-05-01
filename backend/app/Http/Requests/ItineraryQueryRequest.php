<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\ItineraryType;

class ItineraryQueryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // API pública, no requiere auth
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $validTypes = array_column(ItineraryType::cases(), 'value');
        $validTimezones = timezone_identifiers_list();

        return [
            'tipo' => ['required', 'string', Rule::in($validTypes)],
            'timezone' => ['required', 'string', Rule::in($validTimezones)],
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'tipo.required' => 'El tipo de itinerario es requerido',
            'tipo.in' => 'Tipo de itinerario inválido. Valores permitidos: 4D/3N, 5D/4N, 8D/7N',
            'timezone.required' => 'La zona horaria es requerida',
            'timezone.in' => 'Zona horaria inválida',
        ];
    }
}