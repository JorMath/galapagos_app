<?php

namespace App\Services;

use App\Models\Boat;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class BoatService
{
    /**
     * Create a new boat with image upload.
     */
    public function createBoat(array $data): Boat
    {
        $this->validateBoatData($data);

        if (! empty($data['imagen'])) {
            $data['imagen'] = $data['imagen']->store('boats', 'public');
        }

        return Boat::create($data);
    }

    /**
     * Update an existing boat.
     */
    public function updateBoat(Boat $boat, array $data): Boat
    {
        $this->validateBoatData($data, $boat->id);

        if (! empty($data['imagen'])) {
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

    /**
     * Validate boat data.
     */
    private function validateBoatData(array $data, ?int $excludeId = null): void
    {
        $errors = [];

        // Nombre requerido
        if (empty($data['nombre'])) {
            $errors[] = 'El nombre del barco es requerido';
        } elseif (strlen($data['nombre']) > 255) {
            $errors[] = 'El nombre no puede exceder 255 caracteres';
        }

        // Verificar nombre único
        $query = Boat::where('nombre', $data['nombre']);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        if ($query->exists()) {
            $errors[] = 'Ya existe un barco con ese nombre';
        }

        // Capacidad debe ser positiva
        if (! empty($data['capacidad_pasajeros'])) {
            if (! is_numeric($data['capacidad_pasajeros']) || $data['capacidad_pasajeros'] < 1) {
                $errors[] = 'La capacidad de pasajeros debe ser un número positivo';
            }
        }

        // Imagen debe ser archivo válido si se proporciona
        if (! empty($data['imagen']) && ! $data['imagen']->isValid()) {
            $errors[] = 'La imagen no es válida';
        }

        if (! empty($errors)) {
            throw new InvalidArgumentException(implode('. ', $errors));
        }
    }
}
