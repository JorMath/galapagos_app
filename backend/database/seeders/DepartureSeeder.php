<?php

namespace Database\Seeders;

use App\Enums\ItineraryType;
use App\Models\Departure;
use Illuminate\Database\Seeder;

class DepartureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $itineraries = [
            // 4D/3N - 4 departures
            [
                'barco_id' => 1,
                'fecha_salida' => now()->addDays(10)->setHour(8)->setMinute(0),
                'puerto_salida' => 'Baltra',
                'itinerario_tipo' => ItineraryType::FOUR_DAYS_THREE_NIGHTS->value,
                'pasajeros_reservados' => 45,
                'precio' => 2500.00,
            ],
            [
                'barco_id' => 2,
                'fecha_salida' => now()->addDays(15)->setHour(8)->setMinute(0),
                'puerto_salida' => 'San Cristóbal',
                'itinerario_tipo' => ItineraryType::FOUR_DAYS_THREE_NIGHTS->value,
                'pasajeros_reservados' => 12,
                'precio' => 2200.00,
            ],
            [
                'barco_id' => 3,
                'fecha_salida' => now()->addDays(20)->setHour(8)->setMinute(0),
                'puerto_salida' => 'Baltra',
                'itinerario_tipo' => ItineraryType::FOUR_DAYS_THREE_NIGHTS->value,
                'pasajeros_reservados' => 30,
                'precio' => 1800.00,
            ],
            [
                'barco_id' => 1,
                'fecha_salida' => now()->addDays(25)->setHour(8)->setMinute(0),
                'puerto_salida' => 'San Cristóbal',
                'itinerario_tipo' => ItineraryType::FOUR_DAYS_THREE_NIGHTS->value,
                'pasajeros_reservados' => 60,
                'precio' => 2600.00,
            ],
            // 5D/4N - 3 departures
            [
                'barco_id' => 2,
                'fecha_salida' => now()->addDays(12)->setHour(8)->setMinute(0),
                'puerto_salida' => 'Baltra',
                'itinerario_tipo' => ItineraryType::FIVE_DAYS_FOUR_NIGHTS->value,
                'pasajeros_reservados' => 14,
                'precio' => 2800.00,
            ],
            [
                'barco_id' => 3,
                'fecha_salida' => now()->addDays(18)->setHour(8)->setMinute(0),
                'puerto_salida' => 'San Cristóbal',
                'itinerario_tipo' => ItineraryType::FIVE_DAYS_FOUR_NIGHTS->value,
                'pasajeros_reservados' => 40,
                'precio' => 2400.00,
            ],
            [
                'barco_id' => 1,
                'fecha_salida' => now()->addDays(30)->setHour(8)->setMinute(0),
                'puerto_salida' => 'Baltra',
                'itinerario_tipo' => ItineraryType::FIVE_DAYS_FOUR_NIGHTS->value,
                'pasajeros_reservados' => 85,
                'precio' => 3200.00,
            ],
            // 8D/7N - 3 departures
            [
                'barco_id' => 1,
                'fecha_salida' => now()->addDays(8)->setHour(8)->setMinute(0),
                'puerto_salida' => 'Baltra',
                'itinerario_tipo' => ItineraryType::EIGHT_DAYS_SEVEN_NIGHTS->value,
                'pasajeros_reservados' => 95,
                'precio' => 4500.00,
            ],
            [
                'barco_id' => 3,
                'fecha_salida' => now()->addDays(22)->setHour(8)->setMinute(0),
                'puerto_salida' => 'San Cristóbal',
                'itinerario_tipo' => ItineraryType::EIGHT_DAYS_SEVEN_NIGHTS->value,
                'pasajeros_reservados' => 48,
                'precio' => 3800.00,
            ],
            [
                'barco_id' => 2,
                'fecha_salida' => now()->addDays(35)->setHour(8)->setMinute(0),
                'puerto_salida' => 'Baltra',
                'itinerario_tipo' => ItineraryType::EIGHT_DAYS_SEVEN_NIGHTS->value,
                'pasajeros_reservados' => 16,
                'precio' => 4200.00,
            ],
        ];

        foreach ($itineraries as $departure) {
            Departure::create($departure);
        }
    }
}