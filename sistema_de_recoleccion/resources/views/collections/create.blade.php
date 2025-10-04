@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-3xl font-extrabold mb-6 pl-3 border-l-4 border-emerald-600 text-emerald-800">Solicitar Recolección</h1>

    <div class="bg-white shadow-sm rounded p-6">
        <form method="POST" action="{{ route('collections.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tipo</label>
                    <select name="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="organic">Orgánico</option>
                        <option value="inorganic">Inorgánico</option>
                        <option value="hazardous">Peligroso</option>
                    </select>
                    @error('type') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Modo</label>
                    <select name="mode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="programada">Programada</option>
                        <option value="demanda">Por demanda</option>
                    </select>
                    @error('mode') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Frecuencia (veces/semana)</label>
                    <input type="number" name="frequency" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-emerald-500 focus:border-emerald-500" />
                    @error('frequency') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha programada</label>
                    <input type="datetime-local" name="scheduled_at" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-emerald-500 focus:border-emerald-500" />
                    @error('scheduled_at') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Notas</label>
                <textarea name="notes" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-emerald-500 focus:border-emerald-500" rows="4"></textarea>
                @error('notes') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mt-6 flex items-center gap-3">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-700 text-white text-sm font-medium rounded shadow hover:bg-emerald-800">Enviar solicitud</button>
                <a href="{{ route('collections.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 text-sm font-medium rounded hover:bg-gray-200">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
