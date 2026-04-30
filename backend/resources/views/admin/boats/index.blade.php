@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Barcos</h1>
        <a href="{{ route('admin.boats.create') }}" class="btn-primary">
            Nuevo Barco
        </a>
    </div>
@endsection

@section('content')
    @include('partials.alert')

    <div class="card">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="w-24">Imagen</th>
                        <th>Nombre</th>
                        <th>Capacidad</th>
                        <th>Descripción</th>
                        <th class="w-24">Estado</th>
                        <th class="w-32">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($boats as $boat)
                        <tr>
                            <td>
                                @if($boat->image_path)
                                    <img src="{{ asset('storage/' . $boat->image_path) }}"
                                         alt="{{ $boat->name }}"
                                         class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="font-medium text-gray-900">{{ $boat->name }}</td>
                            <td>{{ $boat->passenger_capacity }} pasajeros</td>
                            <td class="max-w-xs truncate">{{ $boat->description ?? 'Sin descripción' }}</td>
                            <td>
                                @if($boat->is_active)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-error">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.boats.edit', $boat) }}"
                                       class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                                        Editar
                                    </a>
                                    <form action="{{ route('admin.boats.destroy', $boat) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Estás seguro de que deseas eliminar este barco?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-700 text-sm font-medium">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">
                                No hay barcos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($boats->hasPages())
            <div class="mt-4">
                {{ $boats->links() }}
            </div>
        @endif
    </div>
@endsection