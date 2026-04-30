<?php

namespace App\Http\Requests;

use App\Enums\ItineraryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDepartureRequest extends FormRequest
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
        $itineraryTypes = array_column(ItineraryType::cases(), 'value');

        return [
            'boat_id' => ['required', 'exists:boats,id'],
            'departure_at' => ['required', 'date'],
            'departure_port' => ['required', 'string', 'max:255'],
            'itinerary_type' => ['required', Rule::in($itineraryTypes)],
            'reserved_passengers' => ['nullable', 'integer', 'min:0'],
            'price_per_person' => ['required', 'numeric', 'min:0'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'boat_id.required' => 'El barco es requerido.',
            'boat_id.exists' => 'El barco seleccionado no existe.',
            'departure_at.required' => 'La fecha y hora de salida es requerida.',
            'departure_at.date' => 'La fecha debe ser válida.',
            'departure_port.required' => 'El puerto de salida es requerido.',
            'departure_port.max' => 'El nombre del puerto no puede exceder 255 caracteres.',
            'itinerary_type.required' => 'El tipo de itinerario es requerido.',
            'itinerary_type.in' => 'El tipo de itinerario seleccionado no es válido.',
            'reserved_passengers.integer' => 'Los pasajeros reservados deben ser un número entero.',
            'reserved_passengers.min' => 'Los pasajeros reservados no pueden ser negativos.',
            'price_per_person.required' => 'El precio por persona es requerido.',
            'price_per_person.numeric' => 'El precio debe ser un número.',
            'price_per_person.min' => 'El precio no puede ser negativo.',
        ];
    }
}