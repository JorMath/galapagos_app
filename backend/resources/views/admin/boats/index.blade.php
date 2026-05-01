@extends('layouts.admin')

@section('header')
    <div class="flex justify-between items-center animate-enter">
        <div>
            <h1 class="font-display text-2xl font-medium text-gray-900 tracking-wide">Barcos</h1>
            <p class="mt-1 text-sm text-gray-500">Gestiona la flota de barcos turísticos</p>
        </div>
        <a href="{{ route('boats.create') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 rounded-lg tracking-wide transition-all duration-200 shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nuevo Barco
        </a>
    </div>
@endsection

@section('content')
    @include('partials.alert')

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm animate-enter delay-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="w-24 px-6 py-4 bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-200">Imagen</th>
                        <th class="px-6 py-4 bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-200">Nombre</th>
                        <th class="px-6 py-4 bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-200">Capacidad</th>
                        <th class="px-6 py-4 bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-200">Descripción</th>
                        <th class="w-24 px-6 py-4 bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-200 text-center">Estado</th>
                        <th class="w-28 px-6 py-4 bg-gray-50 text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-200 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($boats as $boat)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 border-b border-gray-100">
                                @if($boat->imagen)
                                    <img src="{{ asset('storage/' . $boat->imagen) }}" alt="{{ $boat->nombre }}" class="w-14 h-14 object-cover border border-gray-200">
                                @else
                                    <div class="w-14 h-14 bg-gray-100 border border-gray-200 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 border-b border-gray-100">
                                <span class="font-medium text-gray-900">{{ $boat->nombre }}</span>
                            </td>
                            <td class="px-6 py-4 border-b border-gray-100">
                                <span class="text-gray-600">{{ $boat->capacidad_pasajeros }} pasajeros</span>
                            </td>
                            <td class="px-6 py-4 border-b border-gray-100">
                                <span class="text-gray-500 max-w-xs block truncate">{{ $boat->descripcion ?? 'Sin descripción' }}</span>
                            </td>
                            <td class="px-6 py-4 border-b border-gray-100 text-center">
                                @if($boat->activo)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Activo</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Inactivo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 border-b border-gray-100">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('boats.edit', $boat) }}" class="p-2 text-gray-400 hover:text-gray-900 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('boats.destroy', $boat) }}" method="POST" class="inline" id="delete-boat-{{ $boat->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="p-2 text-gray-400 hover:text-red-600 transition-colors" data-confirm-modal="open" data-form-id="delete-boat-{{ $boat->id }}" data-item-name="{{ $boat->nombre }}">
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
        @if($boats->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $boats->links() }}
            </div>
        @endif
    </div>
    @include('partials.confirm-modal')
@endsection