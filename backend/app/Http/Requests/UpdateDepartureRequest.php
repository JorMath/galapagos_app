<?php

namespace App\Http\Requests;

use App\Enums\ItineraryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Boat;

class UpdateDepartureRequest extends FormRequest
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
            'boat_id' => ['sometimes', 'required', 'exists:boats,id'],
            'fecha_salida' => ['sometimes', 'required', 'date'],
            'puerto_salida' => ['sometimes', 'required', 'string', 'max:255'],
            'itinerario_tipo' => ['sometimes', 'required', Rule::in($itineraryTypes)],
            'pasajeros_reservados' => [
                'nullable',
                'integer',
                'min:0',
                function ($attribute, $value, $fail) {
                    $boatId = $this->input('boat_id');
                    if ($boatId && $value !== null) {
                        $boat = Boat::find($boatId);
                        if ($boat && $value > $boat->capacidad_pasajeros) {
                            $fail("La capacidad máxima del barco es {$boat->capacidad_pasajeros} pasajeros.");
                        }
                    }
                },
            ],
            'precio' => ['sometimes', 'required', 'numeric', 'min:0'],
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
            'fecha_salida.required' => 'La fecha y hora de salida es requerida.',
            'fecha_salida.date' => 'La fecha debe ser válida.',
            'puerto_salida.required' => 'El puerto de salida es requerido.',
            'puerto_salida.max' => 'El nombre del puerto no puede exceder 255 caracteres.',
            'itinerario_tipo.required' => 'El tipo de itinerario es requerido.',
            'itinerario_tipo.in' => 'El tipo de itinerario seleccionado no es válido.',
            'pasajeros_reservados.integer' => 'Los pasajeros reservados deben ser un número entero.',
            'pasajeros_reservados.min' => 'Los pasajeros reservados no pueden ser negativos.',
            'precio.required' => 'El precio por persona es requerido.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio no puede ser negativo.',
        ];
    }
}