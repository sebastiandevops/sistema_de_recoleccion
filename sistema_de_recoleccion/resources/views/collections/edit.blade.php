@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-3xl font-extrabold mb-6" style="color:#065f46;padding-left:12px;border-left:4px solid #16a34a;">Editar Solicitud #{{ $collection->id }}</h1>

    <div class="bg-white shadow-sm rounded p-6">
        <form method="POST" action="{{ route('collections.update', $collection) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tipo</label>
                    <select name="type" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="organic" @if($collection->type==='organic') selected @endif>Orgánico</option>
                        <option value="inorganic" @if($collection->type==='inorganic') selected @endif>Inorgánico</option>
                        <option value="hazardous" @if($collection->type==='hazardous') selected @endif>Peligroso</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Modo</label>
                    <select name="mode" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="programada" @if($collection->mode==='programada') selected @endif>Programada</option>
                        <option value="demanda" @if($collection->mode==='demanda') selected @endif>Por demanda</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Frecuencia (veces/semana)</label>
                    <input type="number" name="frequency" value="{{ $collection->frequency }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-emerald-500 focus:border-emerald-500" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha programada</label>
                    <input type="datetime-local" name="scheduled_at" value="{{ optional($collection->scheduled_at)->format('Y-m-d\TH:i') }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-emerald-500 focus:border-emerald-500" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Kilos</label>
                    <input type="number" step="0.01" name="kilos" value="{{ $collection->kilos }}" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-emerald-500 focus:border-emerald-500" />
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Notas</label>
                    <textarea name="notes" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-emerald-500 focus:border-emerald-500" rows="4">{{ $collection->notes }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Estado</label>
                    <select name="status" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="scheduled" @if($collection->status==='scheduled') selected @endif>Programada</option>
                        <option value="completed" @if($collection->status==='completed') selected @endif>Completada</option>
                        <option value="cancelled" @if($collection->status==='cancelled') selected @endif>Cancelada</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-3">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-700 text-white text-sm font-medium rounded shadow hover:bg-emerald-800" style="background-color:#16a34a;color:#ffffff;">Actualizar</button>
                <a href="{{ route('collections.show', $collection) }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 text-sm font-medium rounded hover:bg-gray-200" style="background-color:#e5e7eb;color:#111827;">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
