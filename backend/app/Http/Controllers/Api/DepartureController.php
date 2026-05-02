<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DepartureResource;
use App\Models\Departure;
use Illuminate\Http\JsonResponse;

class DepartureController extends Controller
{
    /**
     * Listar todas las salidas
     */
    public function index(): JsonResponse
    {
        try {
            $departures = Departure::with('boat')->get();

            return response()->json([
                'success' => true,
                'data' => DepartureResource::collection($departures),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener las salidas',
            ], 500);
        }
    }
}
