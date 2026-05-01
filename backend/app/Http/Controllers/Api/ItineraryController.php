<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ItineraryConversionService;
use App\Http\Requests\ItineraryQueryRequest;
use Illuminate\Http\JsonResponse;

class ItineraryController extends Controller
{
    protected ItineraryConversionService $conversionService;

    public function __construct(ItineraryConversionService $conversionService)
    {
        $this->conversionService = $conversionService;
    }

    /**
     * Consultar itinerarios por tipo y timezone
     * GET /api/itinerarios/consulta?tipo=5D/4N&timezone=America/Guayaquil
     */
    public function consulta(ItineraryQueryRequest $request): JsonResponse
    {
        try {
            $tipo = $request->validated('tipo');
            $timezone = $request->validated('timezone');

            $result = $this->conversionService->convert($tipo, $timezone);

            // Si hay error del servicio, retornar con código apropiado
            if (isset($result['error'])) {
                return response()->json([
                    'success' => false,
                    'error' => $result['error'],
                ], 400);
            }

            return response()->json([
                'success' => true,
                'data' => $result,
                'meta' => [
                    'tipo' => $tipo,
                    'timezone' => $timezone,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al consultar itinerarios',
                'mensaje' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}