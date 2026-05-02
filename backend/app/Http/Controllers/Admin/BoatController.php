<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoatRequest;
use App\Http\Requests\UpdateBoatRequest;
use App\Models\Boat;
use App\Services\BoatService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BoatController extends Controller
{
    public function __construct(
        private readonly BoatService $boatService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $boats = $this->boatService->getBoats($request);

        return view('admin.boats.index', compact('boats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.boats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBoatRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->boatService->createBoat($data);

        return redirect()->route('boats.index')
            ->with('success', 'Barco creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Boat $boat): View
    {
        return view('admin.boats.edit', compact('boat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoatRequest $request, Boat $boat): RedirectResponse
    {
        $data = $request->validated();

        $this->boatService->updateBoat($boat, $data);

        return redirect()->route('boats.index')
            ->with('success', 'Barco actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boat $boat): RedirectResponse
    {
        $this->boatService->deleteBoat($boat);

        return redirect()->route('boats.index')
            ->with('success', 'Barco eliminado exitosamente.');
    }
}
