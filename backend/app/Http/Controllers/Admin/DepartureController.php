<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartureRequest;
use App\Http\Requests\UpdateDepartureRequest;
use App\Models\Departure;
use App\Services\DepartureService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartureController extends Controller
{
    public function __construct(
        private readonly DepartureService $departureService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $departures = $this->departureService->getDepartures($request);

        return view('admin.departures.index', compact('departures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $boats = $this->departureService->getActiveBoats();

        return view('admin.departures.create', compact('boats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartureRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->departureService->createDeparture($data);

        return redirect()->route('departures.index')
            ->with('success', 'Salida creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departure $departure): View
    {
        $boats = $this->departureService->getActiveBoats();

        return view('admin.departures.edit', compact('departure', 'boats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartureRequest $request, Departure $departure): RedirectResponse
    {
        $data = $request->validated();

        $this->departureService->updateDeparture($departure, $data);

        return redirect()->route('departures.index')
            ->with('success', 'Salida actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departure $departure): RedirectResponse
    {
        $this->departureService->deleteDeparture($departure);

        return redirect()->route('departures.index')
            ->with('success', 'Salida eliminada exitosamente.');
    }
}
