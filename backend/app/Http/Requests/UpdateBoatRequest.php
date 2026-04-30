<?php

namespace App\Http\Requests;

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
        if ($this->has('is_active')) {
            $this->merge([
                'is_active' => $this->is_active === 'on' ? true : false,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'passenger_capacity' => ['sometimes', 'required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
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
            'name.required' => 'El nombre del barco es requerido.',
            'name.max' => 'El nombre no puede exceder 255 caracteres.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.max' => 'La imagen no puede exceder 2MB.',
            'passenger_capacity.required' => 'La capacidad de pasajeros es requerida.',
            'passenger_capacity.integer' => 'La capacidad debe ser un número entero.',
            'passenger_capacity.min' => 'La capacidad mínima es 1.',
        ];
    }
}