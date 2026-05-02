<?php

namespace App\Services;

use App\Enums\ItineraryType;
use App\Models\Departure;
use Carbon\Carbon;
use InvalidArgumentException;

class ItineraryConversionService
{
    /**
     * Convertir salidas a la zona horaria del usuario
     *
     * @param  string  $tipoItinerario  Tipo de itinerario (4D/3N, 5D/4N, 8D/7N)
     * @param  string  $timezone  Zona horaria del usuario
     *
     * @throws InvalidArgumentException Si los parámetros son inválidos
     */
    public function convert(string $tipoItinerario, string $timezone): array
    {
        // Validar tipo de itinerario
        $validTypes = array_column(ItineraryType::cases(), 'value');
        if (! in_array($tipoItinerario, $validTypes)) {
            throw new InvalidArgumentException(
                'Tipo de itinerario inválido. Valores permitidos: '.implode(', ', $validTypes)
            );
        }

        // Validar timezone
        $validTimezones = timezone_identifiers_list();
        if (! in_array($timezone, $validTimezones)) {
            throw new InvalidArgumentException('Zona horaria inválida');
        }

        // Zona horaria de Galápagos (Pacific/Galapagos = UTC-6)
        $galapagosTimezone = 'Pacific/Galapagos';

        // Obtener las salidas para ese tipo de itinerario
        $departures = Departure::with('boat')
            ->where('itinerario_tipo', $tipoItinerario)
            ->orderBy('fecha_salida')
            ->get();

        // Verificar si hay resultados
        if ($departures->isEmpty()) {
            return [
                'itinerario' => $tipoItinerario,
                'timezone_consulta' => $timezone,
                'salidas' => [],
                'mensaje' => 'No hay salidas disponibles para este itinerario',
            ];
        }

        $salidas = [];

        foreach ($departures as $departure) {
            // Verificar que el barco existe
            if (! $departure->boat) {
                continue;
            }

            // Fecha de salida en UTC (Galápagos)
            $salidaGalapagos = Carbon::parse($departure->fecha_salida)
                ->setTimezone($galapagosTimezone);

            // Fecha de salida convertida a la timezone del usuario
            $salidaLocal = Carbon::parse($departure->fecha_salida)
                ->setTimezone($timezone);

            // Calcular retorno (asumiendo duración del tour)
            $diasTour = (int) explode('D', $tipoItinerario)[0];
            $retornoGalapagos = $salidaGalapagos->copy()->addDays($diasTour);
            $retornoLocal = $salidaLocal->copy()->addDays($diasTour);

            $salidas[] = [
                'barco' => $departure->boat->nombre,
                'puerto' => $departure->puerto_salida,
                'salida_galapagos' => $salidaGalapagos->format('Y-m-d H:i:s (P)'),
                'salida_local' => $salidaLocal->format('Y-m-d H:i:s (P)'),
                'retorno_galapagos' => $retornoGalapagos->format('Y-m-d H:i:s (P)'),
                'retorno_local' => $retornoLocal->format('Y-m-d H:i:s (P)'),
                'precio' => (float) $departure->precio,
            ];
        }

        return [
            'itinerario' => $tipoItinerario,
            'timezone_consulta' => $timezone,
            'salidas' => $salidas,
        ];
    }
}
