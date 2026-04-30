@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-900">Nuevo Barco</h1>
        <a href="{{ route('admin.boats.index') }}" class="btn-secondary">
            Volver
        </a>
    </div>
@endsection

@section('content')
    @include('partials.alert')

    <div class="card">
        <form action="{{ route('admin.boats.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Nombre -->
            <div>
                <label for="name" class="form-label">Nombre del Barco</label>
                <input type="text"
                       id="name"
                       name="name"
                       class="form-input"
                       value="{{ old('name') }}"
                       required>
            </div>

            <!-- Imagen -->
            <div>
                <label for="image" class="form-label">Imagen</label>
                <div class="mt-2">
                    <div id="image-preview-container" class="mb-4 hidden">
                        <img id="image-preview" class="w-48 h-48 object-cover rounded-lg border border-gray-200">
                    </div>
                    <input type="file"
                           id="image"
                           name="image"
                           class="form-input"
                           accept="image/*"
                           onchange="previewImage(event)">
                    <p class="mt-1 text-sm text-gray-500">Máx: 2MB. Formatos: JPG, PNG, GIF.</p>
                </div>
            </div>

            <!-- Capacidad -->
            <div>
                <label for="passenger_capacity" class="form-label">Capacidad de Pasajeros</label>
                <input type="number"
                       id="passenger_capacity"
                       name="passenger_capacity"
                       class="form-input"
                       value="{{ old('passenger_capacity') }}"
                       min="1"
                       required>
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="form-label">Descripción</label>
                <textarea id="description"
                          name="description"
                          class="form-input"
                          rows="4">{{ old('description') }}</textarea>
            </div>

            <!-- Estado -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox"
                           name="is_active"
                           value="1"
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-primary-500 focus:ring-primary-500">
                    <span class="ml-2 text-sm text-gray-600">Activo</span>
                </label>
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.boats.index') }}" class="btn-secondary">
                    Cancelar
                </a>
                <button type="submit" class="btn-primary">
                    Crear Barco
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