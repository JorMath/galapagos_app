<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartureRequest;
use App\Http\Requests\UpdateDepartureRequest;
use App\Models\Boat;
use App\Models\Departure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $departures = Departure::with('boat')
            ->orderBy('departure_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.departures.index', compact('departures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $boats = Boat::where('is_active', true)->orderBy('name')->get();

        return view('admin.departures.create', compact('boats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartureRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Departure::create($data);

        return redirect()->route('departures.index')
            ->with('success', 'Salida creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departure $departure): View
    {
        $boats = Boat::where('is_active', true)->orderBy('name')->get();

        return view('admin.departures.edit', compact('departure', 'boats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartureRequest $request, Departure $departure): RedirectResponse
    {
        $data = $request->validated();

        $departure->update($data);

        return redirect()->route('departures.index')
            ->with('success', 'Salida actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departure $departure): RedirectResponse
    {
        $departure->delete();

        return redirect()->route('departures.index')
            ->with('success', 'Salida eliminada exitosamente.');
    }
}