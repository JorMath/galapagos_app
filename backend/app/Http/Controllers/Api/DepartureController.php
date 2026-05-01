<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departure;
use App\Http\Resources\DepartureResource;

class DepartureController extends Controller
{
    public function index()
    {
        return DepartureResource::collection(Departure::with('boat')->get());
    }
}