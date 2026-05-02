<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BoatResource;
use App\Models\Boat;
use Illuminate\Http\JsonResponse;

class BoatController extends Controller
{
    /**
     * Listar barcos activos
     */
    public function index(): JsonResponse
    {
        try {
            $boats = Boat::where('activo', true)->get();

            return response()->json([
                'success' => true,
                'data' => BoatResource::collection($boats),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener los barcos',
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
            ], 500);
        }
    }
}
