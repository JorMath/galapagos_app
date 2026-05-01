<?php

namespace App\Services;

use App\Models\Departure;
use App\Enums\ItineraryType;
use Carbon\Carbon;

class ItineraryConversionService
{
    /**
     * Convertir salidas a la zona horaria del usuario
     * 
     * @param string $tipoItinerario Tipo de itinerario (4D/3N, 5D/4N, 8D/7N)
     * @param string $timezone Zona horaria del usuario
     * @return array
     */
    public function convert(string $tipoItinerario, string $timezone): array
    {
        // Zona horaria de Galápagos (Pacific/Galapagos = UTC-6)
        $galapagosTimezone = 'Pacific/Galapagos';
        
        // Validar que el tipo de itinerario sea válido
        $validTypes = array_column(ItineraryType::cases(), 'value');
        if (!in_array($tipoItinerario, $validTypes)) {
            return [
                'error' => 'Tipo de itinerario inválido',
                'tipos_validos' => $validTypes
            ];
        }

        // Obtener las salidas para ese tipo de itinerario
        $departures = Departure::with('boat')
            ->where('itinerary_type', $tipoItinerario)
            ->orderBy('departure_at')
            ->get();

        $salidas = [];

        foreach ($departures as $departure) {
            // Fecha de salida en UTC (Galápagos)
            $salidaGalapagos = Carbon::parse($departure->departure_at)
                ->setTimezone($galapagosTimezone);
            
            // Fecha de salida convertida a la timezone del usuario
            $salidaLocal = Carbon::parse($departure->departure_at)
                ->setTimezone($timezone);

            // Calcular retorno (asumiendo duración del tour)
            $diasTour = (int) explode('D', $tipoItinerario)[0];
            $retornoGalapagos = $salidaGalapagos->copy()->addDays($diasTour);
            $retornoLocal = $salidaLocal->copy()->addDays($diasTour);

            $salidas[] = [
                'barco' => $departure->boat->name,
                'puerto' => $departure->departure_port,
                'salida_galapagos' => $salidaGalapagos->format('Y-m-d H:i:s (P)'),
                'salida_local' => $salidaLocal->format('Y-m-d H:i:s (P)'),
                'retorno_galapagos' => $retornoGalapagos->format('Y-m-d H:i:s (P)'),
                'retorno_local' => $retornoLocal->format('Y-m-d H:i:s (P)'),
                'precio' => (float) $departure->price_per_person,
            ];
        }

        return [
            'itinerario' => $tipoItinerario,
            'timezone_consulta' => $timezone,
            'salidas' => $salidas
        ];
    }
}