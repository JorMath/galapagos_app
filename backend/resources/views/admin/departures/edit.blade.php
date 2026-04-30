@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Editar Salida</h1>
        <a href="{{ route('admin.departures.index') }}" class="btn-secondary">
            Volver
        </a>
    </div>
@endsection

@section('content')
    @include('partials.alert')

    <div class="card">
        <form action="{{ route('admin.departures.update', $departure) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Barco -->
            <div>
                <label for="boat_id" class="form-label">Barco</label>
                <select id="boat_id" name="boat_id" class="form-input" required>
                    <option value="">Selecciona un barco</option>
                    @foreach($boats as $boat)
                        <option value="{{ $boat->id }}" {{ old('boat_id', $departure->boat_id) == $boat->id ? 'selected' : '' }}>
                            {{ $boat->name }} ({{ $boat->passenger_capacity }} pasajeros)
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fecha y Hora de Salida -->
            <div>
                <label for="departure_at" class="form-label">Fecha y Hora de Salida</label>
                <input type="datetime-local"
                       id="departure_at"
                       name="departure_at"
                       class="form-input"
                       value="{{ old('departure_at', \Carbon\Carbon::parse($departure->departure_at)->format('Y-m-d\TH:i')) }}"
                       required>
            </div>

            <!-- Puerto de Salida -->
            <div>
                <label for="departure_port" class="form-label">Puerto de Salida</label>
                <input type="text"
                       id="departure_port"
                       name="departure_port"
                       class="form-input"
                       value="{{ old('departure_port', $departure->departure_port) }}"
                       placeholder="Ej: Puerto Ayora"
                       required>
            </div>

            <!-- Tipo de Itinerario -->
            <div>
                <label for="itinerary_type" class="form-label">Tipo de Itinerario</label>
                <select id="itinerary_type" name="itinerary_type" class="form-input" required>
                    <option value="">Selecciona el tipo</option>
                    <option value="4D/3N" {{ old('itinerary_type', $departure->itinerary_type) == '4D/3N' ? 'selected' : '' }}>4 Días / 3 Noches</option>
                    <option value="5D/4N" {{ old('itinerary_type', $departure->itinerary_type) == '5D/4N' ? 'selected' : '' }}>5 Días / 4 Noches</option>
                    <option value="8D/7N" {{ old('itinerary_type', $departure->itinerary_type) == '8D/7N' ? 'selected' : '' }}>8 Días / 7 Noches</option>
                </select>
            </div>

            <!-- Precio por Persona -->
            <div>
                <label for="price_per_person" class="form-label">Precio por Persona ($)</label>
                <input type="number"
                       id="price_per_person"
                       name="price_per_person"
                       class="form-input"
                       value="{{ old('price_per_person', $departure->price_per_person) }}"
                       step="0.01"
                       min="0"
                       placeholder="0.00"
                       required>
            </div>

            <!-- Pasajeros Reservados -->
            <div>
                <label for="reserved_passengers" class="form-label">Pasajeros Reservados</label>
                <input type="number"
                       id="reserved_passengers"
                       name="reserved_passengers"
                       class="form-input"
                       value="{{ old('reserved_passengers', $departure->reserved_passengers ?? 0) }}"
                       min="0"
                       placeholder="0">
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.departures.index') }}" class="btn-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn-primary">
                    Actualizar Salida
                </button>
            </div>
        </form>
    </div>
@endsection