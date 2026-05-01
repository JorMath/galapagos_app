<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Boat;
use App\Http\Resources\BoatResource;

class BoatController extends Controller
{
    public function index()
    {
        $boats = Boat::where('is_active', true)->get();
        return BoatResource::collection($boats);
    }

    public function show(Boat $barco)
    {
        return new BoatResource($barco);
    }
}