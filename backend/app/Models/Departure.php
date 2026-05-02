<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Departure extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'barco_id',
        'fecha_salida',
        'puerto_salida',
        'itinerario_tipo',
        'pasajeros_reservados',
        'precio',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_salida' => 'datetime',
            'pasajeros_reservados' => 'integer',
            'precio' => 'decimal:2',
        ];
    }

    /**
     * Get the boat that owns the departure.
     */
    public function boat(): BelongsTo
    {
        return $this->belongsTo(Boat::class, 'barco_id');
    }
}
