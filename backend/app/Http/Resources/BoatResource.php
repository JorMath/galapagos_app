<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BoatResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'capacidad_pasajeros' => $this->capacidad_pasajeros,
            'descripcion' => $this->descripcion,
            'activo' => $this->activo,
            'imagen_url' => $this->imagen ? asset('storage/' . $this->imagen) : null,
        ];
    }
}