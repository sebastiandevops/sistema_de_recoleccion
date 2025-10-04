@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Mis recolecciones</h1>

    <a href="{{ route('collections.create') }}" class="btn btn-primary mb-4">Solicitar Recolección</a>

    @if($collections->count())
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th>Tipo</th>
                <th>Modo</th>
                <th>Frecuencia (veces/semana)</th>
                <th>Programada</th>
                <th>Kilos</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($collections as $c)
                <tr>
                    <td>{{ $c->type }}</td>
                    <td>{{ $c->mode }}</td>
                    <td>{{ $c->frequency ?? '-' }}</td>
                    <td>{{ optional($c->scheduled_at)->format('Y-m-d H:i') }}</td>
                    <td>{{ $c->kilos ?? '-' }}</td>
                    <td>{{ $c->status }}</td>
                    <td>
                        <a href="{{ route('collections.show', $c) }}">Ver</a>
                        <a href="{{ route('collections.edit', $c) }}">Editar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $collections->links() }}
    @else
        <p>No hay solicitudes registradas.</p>
    @endif
</div>
@endsection
