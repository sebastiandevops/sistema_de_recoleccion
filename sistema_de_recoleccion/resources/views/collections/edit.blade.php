@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Editar Solicitud #{{ $collection->id }}</h1>

    <form method="POST" action="{{ route('collections.update', $collection) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Tipo</label>
            <select name="type" class="form-input">
                <option value="organic" @if($collection->type==='organic') selected @endif>Orgánico</option>
                <option value="inorganic" @if($collection->type==='inorganic') selected @endif>Inorgánico</option>
                <option value="hazardous" @if($collection->type==='hazardous') selected @endif>Peligroso</option>
            </select>
        </div>

        <div class="mb-4">
            <label>Modo</label>
            <select name="mode" class="form-input">
                <option value="programada" @if($collection->mode==='programada') selected @endif>Programada</option>
                <option value="demanda" @if($collection->mode==='demanda') selected @endif>Por demanda</option>
            </select>
        </div>

        <div class="mb-4">
            <label>Frecuencia (veces/semana)</label>
            <input type="number" name="frequency" value="{{ $collection->frequency }}" class="form-input" />
        </div>

        <div class="mb-4">
            <label>Fecha programada</label>
            <input type="datetime-local" name="scheduled_at" value="{{ optional($collection->scheduled_at)->format('Y-m-d\TH:i') }}" class="form-input" />
        </div>

        <div class="mb-4">
            <label>Kilos</label>
            <input type="number" step="0.01" name="kilos" value="{{ $collection->kilos }}" class="form-input" />
        </div>

        <div class="mb-4">
            <label>Notas</label>
            <textarea name="notes" class="form-input">{{ $collection->notes }}</textarea>
        </div>

        <div class="mb-4">
            <label>Estado</label>
            <select name="status" class="form-input">
                <option value="scheduled" @if($collection->status==='scheduled') selected @endif>Programada</option>
                <option value="completed" @if($collection->status==='completed') selected @endif>Completada</option>
                <option value="cancelled" @if($collection->status==='cancelled') selected @endif>Cancelada</option>
            </select>
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
