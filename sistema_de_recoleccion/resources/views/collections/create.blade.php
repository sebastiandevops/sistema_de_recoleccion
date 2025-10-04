@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Solicitar Recolección</h1>

    <form method="POST" action="{{ route('collections.store') }}">
        @csrf

        <div class="mb-4">
            <label>Tipo</label>
            <select name="type" class="form-input">
                <option value="organic">Orgánico</option>
                <option value="inorganic">Inorgánico</option>
                <option value="hazardous">Peligroso</option>
            </select>
        </div>

        <div class="mb-4">
            <label>Modo</label>
            <select name="mode" class="form-input">
                <option value="programada">Programada</option>
                <option value="demanda">Por demanda</option>
            </select>
        </div>

        <div class="mb-4">
            <label>Frecuencia (veces/semana)</label>
            <input type="number" name="frequency" class="form-input" />
        </div>

        <div class="mb-4">
            <label>Fecha programada</label>
            <input type="datetime-local" name="scheduled_at" class="form-input" />
        </div>

        <div class="mb-4">
            <label>Notas</label>
            <textarea name="notes" class="form-input"></textarea>
        </div>

        <button class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
