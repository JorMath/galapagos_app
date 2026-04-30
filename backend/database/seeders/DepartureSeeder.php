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
                'boat_id' => 1,
                'departure_at' => now()->addDays(10)->setHour(8)->setMinute(0),
                'departure_port' => 'Baltra',
                'itinerary_type' => ItineraryType::FOUR_DAYS_THREE_NIGHTS->value,
                'reserved_passengers' => 45,
                'price_per_person' => 2500.00,
            ],
            [
                'boat_id' => 2,
                'departure_at' => now()->addDays(15)->setHour(8)->setMinute(0),
                'departure_port' => 'San Cristóbal',
                'itinerary_type' => ItineraryType::FOUR_DAYS_THREE_NIGHTS->value,
                'reserved_passengers' => 12,
                'price_per_person' => 2200.00,
            ],
            [
                'boat_id' => 3,
                'departure_at' => now()->addDays(20)->setHour(8)->setMinute(0),
                'departure_port' => 'Baltra',
                'itinerary_type' => ItineraryType::FOUR_DAYS_THREE_NIGHTS->value,
                'reserved_passengers' => 30,
                'price_per_person' => 1800.00,
            ],
            [
                'boat_id' => 1,
                'departure_at' => now()->addDays(25)->setHour(8)->setMinute(0),
                'departure_port' => 'San Cristóbal',
                'itinerary_type' => ItineraryType::FOUR_DAYS_THREE_NIGHTS->value,
                'reserved_passengers' => 60,
                'price_per_person' => 2600.00,
            ],
            // 5D/4N - 3 departures
            [
                'boat_id' => 2,
                'departure_at' => now()->addDays(12)->setHour(8)->setMinute(0),
                'departure_port' => 'Baltra',
                'itinerary_type' => ItineraryType::FIVE_DAYS_FOUR_NIGHTS->value,
                'reserved_passengers' => 14,
                'price_per_person' => 2800.00,
            ],
            [
                'boat_id' => 3,
                'departure_at' => now()->addDays(18)->setHour(8)->setMinute(0),
                'departure_port' => 'San Cristóbal',
                'itinerary_type' => ItineraryType::FIVE_DAYS_FOUR_NIGHTS->value,
                'reserved_passengers' => 40,
                'price_per_person' => 2400.00,
            ],
            [
                'boat_id' => 1,
                'departure_at' => now()->addDays(30)->setHour(8)->setMinute(0),
                'departure_port' => 'Baltra',
                'itinerary_type' => ItineraryType::FIVE_DAYS_FOUR_NIGHTS->value,
                'reserved_passengers' => 85,
                'price_per_person' => 3200.00,
            ],
            // 8D/7N - 3 departures
            [
                'boat_id' => 1,
                'departure_at' => now()->addDays(8)->setHour(8)->setMinute(0),
                'departure_port' => 'Baltra',
                'itinerary_type' => ItineraryType::EIGHT_DAYS_SEVEN_NIGHTS->value,
                'reserved_passengers' => 95,
                'price_per_person' => 4500.00,
            ],
            [
                'boat_id' => 3,
                'departure_at' => now()->addDays(22)->setHour(8)->setMinute(0),
                'departure_port' => 'San Cristóbal',
                'itinerary_type' => ItineraryType::EIGHT_DAYS_SEVEN_NIGHTS->value,
                'reserved_passengers' => 48,
                'price_per_person' => 3800.00,
            ],
            [
                'boat_id' => 2,
                'departure_at' => now()->addDays(35)->setHour(8)->setMinute(0),
                'departure_port' => 'Baltra',
                'itinerary_type' => ItineraryType::EIGHT_DAYS_SEVEN_NIGHTS->value,
                'reserved_passengers' => 16,
                'price_per_person' => 4200.00,
            ],
        ];

        foreach ($itineraries as $departure) {
            Departure::create($departure);
        }
    }
}