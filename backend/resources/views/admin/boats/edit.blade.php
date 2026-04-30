@extends('layouts.admin')

@section('header')
    <div class="flex items-center gap-4">
        <a href="{{ route('boats.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-display font-semibold text-gray-900">Editar Barco</h1>
            <p class="mt-1 text-sm text-gray-500">Modifica los datos del barco</p>
        </div>
    </div>
@endsection

@section('content')
    @include('partials.alert')

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form action="{{ route('boats.update', $boat) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombre -->
                <div>
                    <label for="name" class="form-label">Nombre del Barco</label>
                    <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $boat->name) }}" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Capacidad -->
                <div>
                    <label for="passenger_capacity" class="form-label">Capacidad de Pasajeros</label>
                    <input type="number" name="passenger_capacity" id="passenger_capacity" class="form-input" value="{{ old('passenger_capacity', $boat->passenger_capacity) }}" min="1" required>
                    @error('passenger_capacity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Imagen -->
                <div>
                    <label class="form-label">Imagen</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                        <div class="space-y-1 text-center">
                            @if($boat->image_path)
                                <img id="preview" src="{{ asset('storage/' . $boat->image_path) }}" class="mx-auto h-48 w-auto object-cover rounded-lg" alt="Imagen actual">
                            @else
                                <img id="preview" class="mx-auto h-48 w-auto object-cover rounded-lg hidden" alt="Preview">
                            @endif
                            <div id="placeholder" class="{{ $boat->image_path ? 'hidden' : '' }}">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <p class="mt-1 text-sm text-gray-600">
                                <label for="image" class="relative cursor-pointer rounded-md font-medium text-gray-900 hover:text-gray-700">
                                    <span>{{ $boat->image_path ? 'Cambiar' : 'Subir' }} imagen</span>
                                    <input type="file" name="image" id="image" class="sr-only" accept="image/*">
                                </label>
                            </p>
                            <p class="text-xs text-gray-500">PNG, JPG hasta 2MB</p>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" class="h-4 w-4 text-gray-900 border-gray-300 rounded focus:ring-gray-900" {{ old('is_active', $boat->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="ml-2 text-sm font-medium text-gray-700">Barco activo</label>
                </div>
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="form-label">Descripción</label>
                <textarea name="description" id="description" rows="4" class="form-input">{{ old('description', $boat->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('boats.index') }}" class="btn-secondary">Cancelar</a>
                <button type="submit" class="btn-primary">Actualizar Barco</button>
            </div>
        </form>
    </div>

    <script>
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('preview');
        const placeholder = document.getElementById('placeholder');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection