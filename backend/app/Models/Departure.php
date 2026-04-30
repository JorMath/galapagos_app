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
        'boat_id',
        'departure_at',
        'departure_port',
        'itinerary_type',
        'reserved_passengers',
        'price_per_person',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'departure_at' => 'datetime',
            'reserved_passengers' => 'integer',
            'price_per_person' => 'decimal:2',
        ];
    }

    /**
     * Get the boat that owns the departure.
     */
    public function boat(): BelongsTo
    {
        return $this->belongsTo(Boat::class);
    }
}