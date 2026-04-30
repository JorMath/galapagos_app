@extends('layouts.admin')

@section('header')
    <div class="flex items-center gap-4">
        <a href="{{ route('departures.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-display font-semibold text-gray-900">Nueva Salida</h1>
            <p class="mt-1 text-sm text-gray-500">Programa una nueva salida de barco</p>
        </div>
    </div>
@endsection

@section('content')
    @include('partials.alert')

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form action="{{ route('departures.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Barco -->
                <div>
                    <label for="boat_id" class="form-label">Barco</label>
                    <select name="boat_id" id="boat_id" class="form-input" required>
                        <option value="">Seleccionar barco</option>
                        @foreach(\App\Models\Boat::where('is_active', true)->orderBy('name')->get() as $boat)
                            <option value="{{ $boat->id }}" {{ old('boat_id') == $boat->id ? 'selected' : '' }}>
                                {{ $boat->name }} ({{ $boat->passenger_capacity }} pasajeros)
                            </option>
                        @endforeach
                    </select>
                    @error('boat_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Itinerario -->
                <div>
                    <label for="itinerary_type" class="form-label">Tipo de Itinerario</label>
                    <select name="itinerary_type" id="itinerary_type" class="form-input" required>
                        <option value="">Seleccionar itinerario</option>
                        @foreach(\App\Enums\ItineraryType::cases() as $type)
                            <option value="{{ $type->value }}" {{ old('itinerary_type') == $type->value ? 'selected' : '' }}>
                                {{ $type->value }}
                            </option>
                        @endforeach
                    </select>
                    @error('itinerary_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha y Hora -->
                <div>
                    <label for="departure_at" class="form-label">Fecha y Hora de Salida</label>
                    <input type="datetime-local" name="departure_at" id="departure_at" class="form-input" value="{{ old('departure_at') }}" required>
                    @error('departure_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Puerto -->
                <div>
                    <label for="departure_port" class="form-label">Puerto de Salida</label>
                    <input type="text" name="departure_port" id="departure_port" class="form-input" value="{{ old('departure_port') }}" placeholder="ej: Puerto Ayora" required>
                    @error('departure_port')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Precio -->
                <div>
                    <label for="price_per_person" class="form-label">Precio por Persona ($)</label>
                    <input type="number" name="price_per_person" id="price_per_person" class="form-input" value="{{ old('price_per_person') }}" step="0.01" min="0" required>
                    @error('price_per_person')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pasajeros Reservados -->
                <div>
                    <label for="reserved_passengers" class="form-label">Pasajeros Reservados</label>
                    <input type="number" name="reserved_passengers" id="reserved_passengers" class="form-input" value="{{ old('reserved_passengers', 0) }}" min="0">
                    @error('reserved_passengers')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('departures.index') }}" class="btn-secondary">Cancelar</a>
                <button type="submit" class="btn-primary">Crear Salida</button>
            </div>
        </form>
    </div>
@endsection