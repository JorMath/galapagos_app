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
            'boat_name' => $this->boat->name,
            'departure_at' => $this->departure_at,
            'departure_port' => $this->departure_port,
            'itinerary_type' => $this->itinerary_type,
            'price_per_person' => $this->price_per_person,
            'reserved_passengers' => $this->reserved_passengers,
        ];
    }
}