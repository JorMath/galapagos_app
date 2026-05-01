<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Boat;
use App\Http\Requests\Api\BoatQueryRequest;
use App\Http\Resources\BoatResource;
use Illuminate\Http\JsonResponse;

class BoatController extends Controller
{
    /**
     * Listar barcos activos (o todos con filtro)
     */
    public function index(BoatQueryRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $query = Boat::query();

            // Incluir inactivos si se especifica
            if (!$request->has('incluir_inactivos')) {
                $query->where('activo', true);
            }

            // Ordenar
            $ordenarPor = $data['ordenar_por'] ?? 'nombre';
            $orden = $data['orden'] ?? 'asc';
            $query->orderBy($ordenarPor, $orden);

            $boats = $query->get();

            return response()->json([
                'success' => true,
                'data' => BoatResource::collection($boats),
                'meta' => [
                    'total' => $boats->count(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener los barcos',
                'mensaje' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Ver un barco específico
     */
    public function show(Boat $barco): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'data' => new BoatResource($barco),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener el barco',
                'mensaje' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}