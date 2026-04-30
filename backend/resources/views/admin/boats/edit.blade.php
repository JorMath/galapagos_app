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
                    <input type="text" name="name" id="name" class="form-input rounded-lg" value="{{ old('name', $boat->name) }}" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Capacidad -->
                <div>
                    <label for="passenger_capacity" class="form-label">Capacidad de Pasajeros</label>
                    <input type="number" name="passenger_capacity" id="passenger_capacity" class="form-input rounded-lg" value="{{ old('passenger_capacity', $boat->passenger_capacity) }}" min="1" required>
                    @error('passenger_capacity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Imagen -->
                <div>
                    <label class="form-label">Imagen del Barco</label>
                    <div class="relative mt-1" id="dropzone-container">
                        <div id="dropzone" class="flex flex-col items-center justify-center px-6 py-8 border-2 border-gray-200 border-dashed rounded-xl bg-gray-50 hover:bg-gray-100 hover:border-gray-300 transition-all duration-200 cursor-pointer group">
                            <!-- Preview Image -->
                            @if($boat->image_path)
                                <img id="preview" src="{{ asset('storage/' . $boat->image_path) }}" class="max-h-64 w-auto object-contain rounded-lg shadow-md mb-4" alt="Imagen actual">
                            @else
                                <img id="preview" class="max-h-64 w-auto object-contain rounded-lg shadow-md hidden mb-4" alt="Preview">
                            @endif
                            <!-- Placeholder -->
                            <div id="placeholder" class="text-center {{ $boat->image_path ? 'hidden' : '' }}">
                                <div class="mx-auto w-16 h-16 mb-4 rounded-full bg-gray-200 flex items-center justify-center group-hover:bg-gray-300 transition-colors">
                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">Arrastra una imagen o haz clic para seleccionar</p>
                                <label for="image" class="btn-secondary cursor-pointer inline-flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <span>{{ $boat->image_path ? 'Cambiar' : 'Subir' }} Imagen</span>
                                    <input type="file" name="image" id="image" class="sr-only" accept="image/*">
                                </label>
                                <p class="text-xs text-gray-400 mt-2">PNG, JPG hasta 2MB</p>
                            </div>
                            @if($boat->image_path)
                                <div id="upload-btn" class="hidden">
                                    <label for="image" class="btn-secondary cursor-pointer inline-flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                        </svg>
                                        <span>Cambiar Imagen</span>
                                        <input type="file" name="image" id="image" class="sr-only" accept="image/*">
                                    </label>
                                </div>
                            @endif
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
                <textarea name="description" id="description" rows="4" class="form-input rounded-lg">{{ old('description', $boat->description) }}</textarea>
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
        const uploadBtn = document.getElementById('upload-btn');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    if (uploadBtn) {
                        uploadBtn.classList.remove('hidden');
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection