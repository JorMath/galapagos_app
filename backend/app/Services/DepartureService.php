<?php

namespace App\Services;

use App\Models\Boat;
use App\Models\Departure;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DepartureService
{
    /**
     * Create a new departure.
     */
    public function createDeparture(array $data): Departure
    {
        return Departure::create($data);
    }

    /**
     * Update an existing departure.
     */
    public function updateDeparture(Departure $departure, array $data): Departure
    {
        $departure->update($data);

        return $departure;
    }

    /**
     * Delete a departure.
     */
    public function deleteDeparture(Departure $departure): void
    {
        $departure->delete();
    }

    /**
     * Get all departures paginated with boat relationship.
     */
    public function getDepartures(Request $request): LengthAwarePaginator
    {
        return Departure::with('boat')
            ->orderBy('fecha_salida', 'desc')
            ->paginate(10)
            ->withQueryString();
    }

    /**
     * Get active boats for departure form.
     */
    public function getActiveBoats(): Collection
    {
        return Boat::where('activo', true)->orderBy('nombre')->get();
    }
}