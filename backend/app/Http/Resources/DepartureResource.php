<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartureResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'barco' => $this->boat->nombre,
            'fecha_salida' => $this->fecha_salida,
            'puerto_salida' => $this->puerto_salida,
            'itinerario_tipo' => $this->itinerario_tipo,
            'precio' => $this->precio,
            'pasajeros_reservados' => $this->pasajeros_reservados,
        ];
    }
}
