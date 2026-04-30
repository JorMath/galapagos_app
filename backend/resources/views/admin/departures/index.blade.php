@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Salidas</h1>
        <a href="{{ route('admin.departures.create') }}" class="btn-primary">
            Nueva Salida
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
                        <th>Barco</th>
                        <th>Fecha/Hora</th>
                        <th>Puerto</th>
                        <th>Itinerario</th>
                        <th>Precio</th>
                        <th>Pasajeros</th>
                        <th class="w-32">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($departures as $departure)
                        <tr>
                            <td class="font-medium text-gray-900">{{ $departure->boat->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($departure->departure_at)->format('d/m/Y H:i') }}</td>
                            <td>{{ $departure->departure_port }}</td>
                            <td>
                                <span class="badge badge-success">{{ $departure->itinerary_type }}</span>
                            </td>
                            <td>${{ number_format($departure->price_per_person, 2) }}</td>
                            <td>
                                @if($departure->reserved_passengers > 0)
                                    <span class="text-gray-900">{{ $departure->reserved_passengers }}</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.departures.edit', $departure) }}"
                                       class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                                        Editar
                                    </a>
                                    <form action="{{ route('admin.departures.destroy', $departure) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta salida?');">
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
                            <td colspan="7" class="text-center py-8 text-gray-500">
                                No hay salidas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($departures->hasPages())
            <div class="mt-4">
                {{ $departures->links() }}
            </div>
        @endif
    </div>
@endsection