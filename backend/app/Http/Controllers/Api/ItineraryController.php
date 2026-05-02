<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItineraryQueryRequest;
use App\Services\ItineraryConversionService;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;

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

            return response()->json([
                'success' => true,
                'data' => $result,
            ]);
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al consultar itinerarios',
            ], 500);
        }
    }
}
