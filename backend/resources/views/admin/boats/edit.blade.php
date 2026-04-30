@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Editar Barco</h1>
        <a href="{{ route('boats.index') }}" class="btn-secondary">
            Volver
        </a>
    </div>
@endsection

@section('content')
    @include('partials.alert')

    <div class="card">
        <form action="{{ route('boats.update', $boat) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div>
                <label for="name" class="form-label">Nombre del Barco</label>
                <input type="text"
                       id="name"
                       name="name"
                       class="form-input"
                       value="{{ old('name', $boat->name) }}"
                       required>
            </div>

            <!-- Imagen -->
            <div>
                <label for="image" class="form-label">Imagen</label>
                <div class="mt-2">
                    @if($boat->image_path)
                        <div id="current-image" class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Imagen actual:</p>
                            <img src="{{ asset('storage/' . $boat->image_path) }}"
                                 alt="{{ $boat->name }}"
                                 class="w-48 h-48 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                    <div id="image-preview-container" class="mb-4 hidden">
                        <p class="text-sm text-gray-500 mb-2">Nueva imagen:</p>
                        <img id="image-preview" class="w-48 h-48 object-cover rounded-lg border border-gray-200">
                    </div>
                    <input type="file"
                           id="image"
                           name="image"
                           class="form-input"
                           accept="image/*"
                           onchange="previewImage(event)">
                    <p class="mt-1 text-sm text-gray-500">Deja vacío para mantener la imagen actual. Máx: 2MB.</p>
                </div>
            </div>

            <!-- Capacidad -->
            <div>
                <label for="passenger_capacity" class="form-label">Capacidad de Pasajeros</label>
                <input type="number"
                       id="passenger_capacity"
                       name="passenger_capacity"
                       class="form-input"
                       value="{{ old('passenger_capacity', $boat->passenger_capacity) }}"
                       min="1"
                       required>
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="form-label">Descripción</label>
                <textarea id="description"
                          name="description"
                          class="form-input"
                          rows="4">{{ old('description', $boat->description) }}</textarea>
            </div>

            <!-- Estado -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', $boat->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-primary-500 focus:ring-primary-500">
                    <span class="ml-2 text-sm text-gray-600">Activo</span>
                </label>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('boats.index') }}" class="btn-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn-primary">
                    Actualizar Barco
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const previewContainer = document.getElementById('image-preview-container');
            const preview = document.getElementById('image-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        }
    </script>
@endsection