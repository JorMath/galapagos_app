<?php

namespace App\Services;

use App\Models\Boat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class BoatService
{
    /**
     * Create a new boat with image upload.
     */
    public function createBoat(array $data): Boat
    {
        if (!empty($data['imagen'])) {
            $data['imagen'] = $data['imagen']->store('boats', 'public');
        }

        return Boat::create($data);
    }

    /**
     * Update an existing boat.
     */
    public function updateBoat(Boat $boat, array $data): Boat
    {
        if (!empty($data['imagen'])) {
            // Delete old image if exists
            if ($boat->imagen) {
                Storage::disk('public')->delete($boat->imagen);
            }
            $data['imagen'] = $data['imagen']->store('boats', 'public');
        }

        $boat->update($data);

        return $boat;
    }

    /**
     * Delete a boat and its image.
     */
    public function deleteBoat(Boat $boat): void
    {
        if ($boat->imagen) {
            Storage::disk('public')->delete($boat->imagen);
        }

        $boat->delete();
    }

    /**
     * Get all boats paginated.
     */
    public function getBoats(Request $request): LengthAwarePaginator
    {
        return Boat::orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
    }
}