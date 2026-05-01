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
        $tipo = $request->validated('tipo');
        $timezone = $request->validated('timezone');

        $result = $this->conversionService->convert($tipo, $timezone);

        return response()->json($result);
    }
}