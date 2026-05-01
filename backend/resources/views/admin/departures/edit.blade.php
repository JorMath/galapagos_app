@extends('layouts.admin')

@section('header')
    <div class="flex items-center gap-4 animate-enter">
        <a href="{{ route('departures.index') }}" class="text-gray-400 hover:text-gray-900 transition-colors p-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h1 class="font-display text-2xl font-medium text-gray-900">Editar Salida</h1>
            <p class="mt-1 text-sm text-gray-500">Modifica los datos de la salida</p>
        </div>
    </div>
@endsection

@section('content')
    @include('partials.alert')

    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm animate-enter delay-100">
        <form action="{{ route('departures.update', $departure) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Barco -->
                <div>
                    <label for="barco_id" class="block text-sm font-medium text-gray-700 mb-2">Barco</label>
                    <select name="barco_id" id="barco_id" class="w-full px-4 py-3 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" required>
                        <option value="">Seleccionar barco...</option>
                        @foreach(\App\Models\Boat::where('activo', true)->orderBy('nombre')->get() as $boat)
                            <option value="{{ $boat->id }}" {{ old('barco_id', $departure->barco_id) == $boat->id ? 'selected' : '' }}>
                                {{ $boat->nombre }} ({{ $boat->capacidad_pasajeros }} pasajeros)
                            </option>
                        @endforeach
                    </select>
                    @error('barco_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Itinerario -->
                <div>
                    <label for="itinerario_tipo" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Itinerario</label>
                    <select name="itinerario_tipo" id="itinerario_tipo" class="w-full px-4 py-3 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" required>
                        <option value="">Seleccionar itinerario...</option>
                        @foreach(\App\Enums\ItineraryType::cases() as $type)
                            <option value="{{ $type->value }}" {{ old('itinerario_tipo', $departure->itinerario_tipo) == $type->value ? 'selected' : '' }}>
                                {{ $type->value }}
                            </option>
                        @endforeach
                    </select>
                    @error('itinerario_tipo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha y Hora -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Fecha y Hora de Salida</label>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="fecha_date" class="block text-xs text-gray-500 mb-1">Fecha</label>
                            <input type="date" name="fecha_date" id="fecha_date" class="w-full px-3 py-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" value="{{ old('fecha_date', \Carbon\Carbon::parse($departure->fecha_salida)->format('Y-m-d')) }}" required>
                        </div>
                        <div>
                            <label for="fecha_time" class="block text-xs text-gray-500 mb-1">Hora</label>
                            <input type="time" name="fecha_time" id="fecha_time" class="w-full px-3 py-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" value="{{ old('fecha_time', \Carbon\Carbon::parse($departure->fecha_salida)->format('H:i')) }}" required>
                        </div>
                    </div>
                    <input type="hidden" name="fecha_salida" id="fecha_salida" value="{{ $departure->fecha_salida }}">
                    @error('fecha_salida')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Puerto -->
                <div>
                    <label for="puerto_salida" class="block text-sm font-medium text-gray-700 mb-2">Puerto de Salida</label>
                    <input type="text" name="puerto_salida" id="puerto_salida" class="w-full px-4 py-3 text-sm text-gray-900 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" value="{{ old('puerto_salida', $departure->puerto_salida) }}" placeholder="ej: Puerto Ayora" required>
                    @error('puerto_salida')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Precio -->
                <div>
                    <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">Precio por Persona ($)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">$</span>
                        <input type="number" name="precio" id="precio" class="w-full pl-8 pr-4 py-3 text-sm text-gray-900 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" value="{{ old('precio', $departure->precio) }}" step="0.01" min="0" placeholder="0.00" required>
                    </div>
                    @error('precio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pasajeros Reservados -->
                <div>
                    <label for="pasajeros_reservados" class="block text-sm font-medium text-gray-700 mb-2">Pasajeros Reservados</label>
                    <input type="number" name="pasajeros_reservados" id="pasajeros_reservados" class="w-full px-4 py-3 text-sm text-gray-900 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-transparent transition-all duration-200" value="{{ old('pasajeros_reservados', $departure->pasajeros_reservados) }}" min="0" placeholder="0">
                    @error('pasajeros_reservados')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                <a href="{{ route('departures.index') }}" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancelar</a>
                <button type="submit" class="px-6 py-2.5 text-sm font-medium text-white bg-gray-900 rounded-lg hover:bg-gray-800 tracking-wide transition-all duration-200 shadow-sm hover:shadow-md">Actualizar Salida</button>
            </div>
        </form>
    </div>

    <script>
        function updateFechaSalida() {
            const fecha = document.getElementById('fecha_date').value;
            const hora = document.getElementById('fecha_time').value;
            document.getElementById('fecha_salida').value = fecha + ' ' + hora;
        }
        
        document.getElementById('fecha_date').addEventListener('change', updateFechaSalida);
        document.getElementById('fecha_time').addEventListener('change', updateFechaSalida);
    </script>
@endsection