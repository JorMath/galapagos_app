<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departure;
use App\Http\Requests\Api\DepartureQueryRequest;
use App\Http\Resources\DepartureResource;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class DepartureController extends Controller
{
    /**
     * Listar salidas con filtros opcionales
     */
    public function index(DepartureQueryRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $query = Departure::with('boat');

            // Filtro por barco
            if (!empty($data['barco_id'])) {
                $query->where('barco_id', $data['barco_id']);
            }

            // Filtro por tipo de itinerario
            if (!empty($data['itinerario_tipo'])) {
                $query->where('itinerario_tipo', $data['itinerario_tipo']);
            }

            // Filtro por rango de fechas
            if (!empty($data['fecha_desde'])) {
                $query->where('fecha_salida', '>=', $data['fecha_desde']);
            }

            if (!empty($data['fecha_hasta'])) {
                $query->where('fecha_salida', '<=', $data['fecha_hasta']);
            }

            // Filtro: solo salidas con disponibilidad
            if ($request->has('disponibles') && $data['disponibles']) {
                $query->where('fecha_salida', '>=', Carbon::now());
            }

            // Ordenar
            $ordenarPor = $data['ordenar_por'] ?? 'fecha_salida';
            $orden = $data['orden'] ?? 'asc';
            $query->orderBy($ordenarPor, $orden);

            // Limite
            $limite = $data['limite'] ?? 100;
            $departures = $query->limit($limite)->get();

            return response()->json([
                'success' => true,
                'data' => DepartureResource::collection($departures),
                'meta' => [
                    'total' => $departures->count(),
                    'filtros' => [
                        'barco_id' => $data['barco_id'] ?? null,
                        'itinerario_tipo' => $data['itinerario_tipo'] ?? null,
                        'fecha_desde' => $data['fecha_desde'] ?? null,
                        'fecha_hasta' => $data['fecha_hasta'] ?? null,
                        'disponibles' => $data['disponibles'] ?? false,
                    ],
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener las salidas',
                'mensaje' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}