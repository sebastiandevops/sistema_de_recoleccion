@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-3xl font-extrabold mb-6" style="color:#065f46;padding-left:12px;border-left:4px solid #16a34a;">Solicitud #{{ $collection->id }}</h1>

    <div class="bg-white shadow-sm rounded p-6">
        <div class="flex items-start justify-between mb-4">
            <div>
                <p class="text-sm text-gray-500">Detalles de la solicitud</p>
                <div class="mt-2 flex items-center gap-3">
                    <span class="text-lg font-semibold">Tipo:</span>
                    <span class="text-md">{{ ucfirst($collection->type) }}</span>
                    <span class="ms-6 text-lg font-semibold">Modo:</span>
                    <span class="text-md">{{ ucfirst($collection->mode) }}</span>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('collections.edit', $collection) }}" class="inline-flex items-center px-4 py-2 bg-emerald-700 text-white text-sm font-medium rounded hover:bg-emerald-800" style="background-color:#16a34a;color:#ffffff;">Editar</a>
                <a href="{{ route('collections.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 text-sm font-medium rounded hover:bg-gray-200" style="background-color:#e5e7eb;color:#111827;">Volver</a>
            </div>
        </div>

        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-sm text-gray-700">
            <div>
                <dt class="font-medium text-gray-900">Frecuencia (veces/semana)</dt>
                <dd class="mt-1">{{ $collection->frequency ?? '-' }}</dd>
            </div>

            <div>
                <dt class="font-medium text-gray-900">Programada</dt>
                <dd class="mt-1">{{ optional($collection->scheduled_at)->format('Y-m-d H:i') ?? '-' }}</dd>
            </div>

            <div>
                <dt class="font-medium text-gray-900">Kilos</dt>
                <dd class="mt-1">{{ $collection->kilos }}</dd>
            </div>

            <div>
                <dt class="font-medium text-gray-900">Estado</dt>
                <dd class="mt-1">
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold text-white" style="background-color:#1f2937;">
                        {{ ucfirst($collection->status) }}
                    </span>
                </dd>
            </div>

            <div class="md:col-span-2">
                <dt class="font-medium text-gray-900">Notas</dt>
                <dd class="mt-1 text-gray-700">{{ $collection->notes ?? '-' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection
