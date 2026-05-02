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
                'nombre' => 'Galápagos Legend',
                'imagen' => 'boats/galapagos-legend.jpg',
                'capacidad_pasajeros' => 100,
                'descripcion' => 'Un barco de lujo con todas las comodidades modernas, ideal para quienes buscan una experiencia premium en las islas Galápagos.',
                'activo' => true,
            ],
            [
                'nombre' => 'Eco Explorer',
                'imagen' => 'boats/eco-explorer.jpg',
                'capacidad_pasajeros' => 16,
                'descripcion' => 'Un barco pequeño y ecológico, perfecto para observación de vida silvestre y experiencias íntimas con la naturaleza.',
                'activo' => true,
            ],
            [
                'nombre' => 'Sea Adventure',
                'imagen' => 'boats/sea-adventure.jpg',
                'capacidad_pasajeros' => 48,
                'descripcion' => 'Barco familiar con excelente relación precio-calidad, ofreciendo rutas versátiles por las principales islas del archipiélago.',
                'activo' => true,
            ],
        ];

        foreach ($boats as $boat) {
            Boat::create($boat);
        }
    }
}
