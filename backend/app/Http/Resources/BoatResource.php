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
            'name' => $this->name,
            'passenger_capacity' => $this->passenger_capacity,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'image_url' => $this->image_path ? asset('storage/' . $this->image_path) : null,
        ];
    }
}