@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Solicitud #{{ $collection->id }}</h1>

    <ul>
        <li>Tipo: {{ $collection->type }}</li>
        <li>Modo: {{ $collection->mode }}</li>
        <li>Frecuencia (veces/semana): {{ $collection->frequency ?? '-' }}</li>
        <li>Programada: {{ optional($collection->scheduled_at)->format('Y-m-d H:i') }}</li>
        <li>Kilos: {{ $collection->kilos }}</li>
        <li>Estado: {{ $collection->status }}</li>
        <li>Notas: {{ $collection->notes }}</li>
    </ul>

    <a href="{{ route('collections.index') }}">Volver</a>
</div>
@endsection
