@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-4">
    <h1 class="text-3xl font-extrabold mb-4" style="color:#065f46;padding-left:12px;border-left:4px solid #16a34a;">Mis recolecciones</h1>

    <a href="{{ route('collections.create') }}" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-medium rounded shadow" style="background-color:#f59e0b;color:#ffffff;text-decoration:none;">
        Solicitar Recolección
    </a>

    @if(session('success'))
        <div class="mb-4 text-sm text-green-600">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 text-sm text-red-600">{{ session('error') }}</div>
    @endif

    @if($collections->count())
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200 table-auto">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Tipo</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Modo</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700" style="min-width:140px;">Frecuencia (veces/semana)</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700" style="min-width:160px;">Programada</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Kilos</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Estado</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700" style="min-width:160px;">Acciones</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($collections as $c)
                    <tr>
                        @php
                            $typeLabels = [
                                'organic' => 'Orgánico',
                                'inorganic' => 'Inorgánico',
                                'hazardous' => 'Peligroso',
                            ];
                        @endphp
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-900">{{ $typeLabels[$c->type] ?? $c->type }}</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-900">{{ $c->mode }}</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-900">{{ $c->frequency ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-900">{{ optional($c->scheduled_at)->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-900">{{ $c->kilos ?? '-' }}</td>
                        @php
                            $statusLabels = [
                                'scheduled' => 'Programada',
                                'completed' => 'Completada',
                                'cancelled' => 'Cancelada',
                            ];
                        @endphp
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-900">{{ $statusLabels[$c->status] ?? $c->status }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ route('collections.show', $c) }}" class="inline-block px-3 py-1 mr-2 text-sm rounded" style="background-color:#e5e7eb;color:#111827;text-decoration:none;">Ver</a>
                            <a href="{{ route('collections.edit', $c) }}" class="inline-block px-3 py-1 text-sm rounded mr-2" style="background-color:#c7f0d6;color:#065f46;text-decoration:none;">Editar</a>

                            @if($c->status === 'scheduled')
                                <form method="POST" action="{{ route('collections.cancel', $c) }}" onsubmit="return confirm('¿Cancelar esta recolección?');" style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-block px-3 py-1 text-sm rounded" style="background-color:#f87171;color:#ffffff;">Cancelar Recolección</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $collections->links() }}
    @else
        <p>No hay solicitudes registradas.</p>
    @endif
</div>
@endsection
