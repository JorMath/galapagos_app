<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBoatRequest;
use App\Http\Requests\UpdateBoatRequest;
use App\Models\Boat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BoatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $boats = Boat::orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

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

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('boats', 'public');
        }

        Boat::create($data);

        return redirect()->route('admin.boats.index')
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

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($boat->image_path) {
                Storage::disk('public')->delete($boat->image_path);
            }
            $data['image_path'] = $request->file('image')->store('boats', 'public');
        }

        $boat->update($data);

        return redirect()->route('admin.boats.index')
            ->with('success', 'Barco actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Boat $boat): RedirectResponse
    {
        // Delete image if exists
        if ($boat->image_path) {
            Storage::disk('public')->delete($boat->image_path);
        }

        $boat->delete();

        return redirect()->route('admin.boats.index')
            ->with('success', 'Barco eliminado exitosamente.');
    }
}