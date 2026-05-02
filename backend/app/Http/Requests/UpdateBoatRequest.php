<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBoatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('activo')) {
            $this->merge([
                'activo' => $this->activo === 'on' ? true : false,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'required', 'string', 'max:255'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'capacidad_pasajeros' => ['sometimes', 'required', 'integer', 'min:1'],
            'descripcion' => ['nullable', 'string'],
            'activo' => ['nullable', 'boolean'],
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
            'nombre.required' => 'El nombre del barco es requerido.',
            'nombre.max' => 'El nombre no puede exceder 255 caracteres.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.max' => 'La imagen no puede exceder 2MB.',
            'capacidad_pasajeros.required' => 'La capacidad de pasajeros es requerida.',
            'capacidad_pasajeros.integer' => 'La capacidad debe ser un número entero.',
            'capacidad_pasajeros.min' => 'La capacidad mínima es 1.',
        ];
    }
}
