@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h1 class="text-3xl font-extrabold mb-6" style="color:#065f46;padding-left:12px;border-left:4px solid #16a34a;">Reportes</h1>

    <div class="bg-white shadow-sm rounded p-6">
        @if(session('status') === 'report-generated')
            <div class="mb-4 text-sm text-green-600">Reporte generado correctamente.</div>
        @endif
        @if(session('status') === 'report-deleted')
            <div class="mb-4 text-sm text-green-600">Reporte eliminado correctamente.</div>
        @endif
        @if(session('status') === 'report-not-found')
            <div class="mb-4 text-sm text-yellow-600">Reporte no encontrado.</div>
        @endif
        @if(session('status') === 'report-delete-failed')
            <div class="mb-4 text-sm text-red-600">No se pudo eliminar el reporte. Intenta nuevamente.</div>
        @endif

        <div class="flex items-center justify-between mb-4">
            <p class="text-sm text-gray-600">Genera y descarga reportes CSV con tus recolecciones.</p>
            <form method="POST" action="{{ route('reports.store') }}">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-700 text-white text-sm font-medium rounded hover:bg-emerald-800" style="background-color:#16a34a;color:#ffffff;">Generar nuevo reporte</button>
            </form>
        </div>

        <div class="mt-4">
            <h3 class="text-lg font-medium">Reportes disponibles</h3>
            <ul class="mt-3 space-y-2">
                @forelse($reports as $r)
                    <li class="flex items-center justify-between bg-gray-50 p-3 rounded">
                        <div>
                            <div class="font-semibold">{{ $r['name'] }}</div>
                            <div class="text-sm text-gray-500">{{ $r['modified'] }}</div>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('reports.download', basename($r['path'])) }}" class="inline-flex items-center px-3 py-2 bg-gray-100 text-gray-800 text-sm font-medium rounded hover:bg-gray-200" style="background-color:#e5e7eb;color:#111827;">Descargar</a>

                            @php $filename = basename($r['path']); @endphp
                            @if(str_starts_with($filename, 'user_'.auth()->id().'_'))
                                <form method="POST" action="{{ route('reports.destroy', $filename) }}" onsubmit="return confirm('¿Eliminar este reporte? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700">Eliminar</button>
                                </form>
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="text-sm text-gray-600">No hay reportes disponibles.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
