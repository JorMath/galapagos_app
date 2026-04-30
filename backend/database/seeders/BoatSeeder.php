<?php

namespace Database\Seeders;

use App\Models\Boat;
use Illuminate\Database\Seeder;

class BoatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boats = [
            [
                'name' => 'Galápagos Legend',
                'image_path' => 'boats/galapagos-legend.jpg',
                'passenger_capacity' => 100,
                'description' => 'Un barco de lujo con todas las comodidades modernas, ideal para quienes buscan una experiencia premium en las islas Galápagos.',
                'is_active' => true,
            ],
            [
                'name' => 'Eco Explorer',
                'image_path' => 'boats/eco-explorer.jpg',
                'passenger_capacity' => 16,
                'description' => 'Un barco pequeño y ecológico, perfecto para observación de vida silvestre y experiencias íntimas con la naturaleza.',
                'is_active' => true,
            ],
            [
                'name' => 'Sea Adventure',
                'image_path' => 'boats/sea-adventure.jpg',
                'passenger_capacity' => 48,
                'description' => 'Barco familiar con excelente relación precio-calidad, ofreciendo rutas versátiles por las principales islas del archipiélago.',
                'is_active' => true,
            ],
        ];

        foreach ($boats as $boat) {
            Boat::create($boat);
        }
    }
}