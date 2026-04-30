@extends('layouts.admin')

@section('header')
    <div class="flex items-center gap-4 animate-entry">
        <a href="{{ route('boats.index') }}" class="text-gray-400 hover:text-gray-900 transition-colors p-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h1 class="font-display text-2xl font-medium text-gray-900">Nuevo Barco</h1>
            <p class="mt-1 text-sm text-gray-500">Agrega un nuevo barco a la flota</p>
        </div>
    </div>
@endsection

@section('content')
    @include('partials.alert')

    <div class="card-elegant p-6 animate-entry delay-100">
        <form action="{{ route('boats.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Nombre -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Barco</label>
                    <input type="text" name="name" id="name" class="input-elegant w-full px-4 py-3 text-sm text-gray-900 placeholder-gray-400 outline-none" value="{{ old('name') }}" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Capacidad -->
                <div>
                    <label for="passenger_capacity" class="block text-sm font-medium text-gray-700 mb-2">Capacidad de Pasajeros</label>
                    <input type="number" name="passenger_capacity" id="passenger_capacity" class="input-elegant w-full px-4 py-3 text-sm text-gray-900 placeholder-gray-400 outline-none" value="{{ old('passenger_capacity') }}" min="1" required>
                    @error('passenger_capacity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Imagen -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Imagen del Barco</label>
                    <div class="relative" id="dropzone-container">
                        <div id="dropzone" class="dropzone-elegant flex flex-col items-center justify-center px-6 py-10 cursor-pointer group">
                            <!-- Preview Image -->
                            <img id="preview" class="max-h-56 w-auto object-contain mb-4 hidden" alt="Preview">
                            <!-- Placeholder -->
                            <div id="placeholder" class="text-center">
                                <div class="mx-auto w-14 h-14 mb-4 bg-gray-100 flex items-center justify-center group-hover:bg-gray-200 transition-colors">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 mb-4">Arrastra una imagen o haz clic para seleccionar</p>
                                <label for="image" class="btn-secondary cursor-pointer inline-flex items-center gap-2 px-4 py-2 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span>Subir Imagen</span>
                                    <input type="file" name="image" id="image" class="sr-only" accept="image/*">
                                </label>
                                <p class="text-xs text-gray-400 mt-3">PNG, JPG hasta 2MB</p>
                            </div>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Estado -->
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" id="is_active" class="w-4 h-4 text-gray-900 border-gray-300 focus:ring-gray-900" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm font-medium text-gray-700">Barco activo</label>
                </div>
            </div>

            <!-- Descripción -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                <textarea name="description" id="description" rows="4" class="input-elegant w-full px-4 py-3 text-sm text-gray-900 placeholder-gray-400 outline-none resize-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
                <a href="{{ route('boats.index') }}" class="btn-secondary px-5 py-2.5 text-sm font-medium">Cancelar</a>
                <button type="submit" class="btn-primary px-6 py-2.5 text-sm font-medium text-white tracking-wide">Guardar Barco</button>
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