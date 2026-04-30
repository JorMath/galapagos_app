@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center animate-entry">
        <div>
            <h1 class="font-display text-2xl font-medium text-gray-900 tracking-wide">Salidas</h1>
            <p class="mt-1 text-sm text-gray-500">Gestiona las salidas programadas de los barcos</p>
        </div>
        <a href="{{ route('departures.create') }}" class="btn-primary flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-white tracking-wide">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nueva Salida
        </a>
    </div>
@endsection

@section('content')
    @include('partials.alert')

    <div class="card-elegant overflow-hidden animate-entry delay-100">
        <div class="overflow-x-auto">
            <table class="table-elegant">
                <thead>
                    <tr>
                        <th>Barco</th>
                        <th>Fecha y Hora</th>
                        <th>Puerto</th>
                        <th>Itinerario</th>
                        <th>Precio</th>
                        <th>Pasajeros</th>
                        <th class="w-28 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departures as $departure)
                        <tr>
                            <td>
                                <span class="font-medium text-gray-900">{{ $departure->boat->name }}</span>
                            </td>
                            <td>
                                <span class="text-gray-900">{{ \Carbon\Carbon::parse($departure->departure_at)->format('d/m/Y H:i') }}</span>
                            </td>
                            <td>
                                <span class="text-gray-600">{{ $departure->departure_port }}</span>
                            </td>
                            <td>
                                <span class="badge-elegant badge-itinerary">
                                    {{ $departure->itinerary_type }}
                                </span>
                            </td>
                            <td>
                                <span class="font-medium text-gray-900">${{ number_format($departure->price_per_person, 2) }}</span>
                            </td>
                            <td>
                                <span class="{{ $departure->reserved_passengers >= $departure->boat->passenger_capacity ? 'text-red-600 font-medium' : 'text-gray-600' }}">
                                    {{ $departure->reserved_passengers }}
                                </span>
                                <span class="text-gray-400"> / {{ $departure->boat->passenger_capacity }}</span>
                            </td>
                            <td>
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('departures.edit', $departure) }}" class="p-2 text-gray-400 hover:text-gray-900 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('departures.destroy', $departure) }}" method="POST" class="inline" id="delete-departure-{{ $departure->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="p-2 text-gray-400 hover:text-red-600 transition-colors" data-confirm-modal="open" data-form-id="delete-departure-{{ $departure->id }}" data-item-name="Salida del {{ \Carbon\Carbon::parse($departure->departure_at)->format('d/m/Y') }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($departures->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $departures->links() }}
            </div>
        @endif
    </div>
    @include('partials.confirm-modal')
@endsection