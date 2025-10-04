<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="background-color:#ecfdf5;">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium">Resumen</h3>
                        <div class="flex gap-2">
                            <a href="{{ route('collections.create') }}" class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700" style="background-color:#16a34a;color:#ffffff;">
                                + Programar Nueva Recolección
                            </a>
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-3 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded hover:bg-gray-300" style="background-color:#e5e7eb;color:#111827;">
                                Configuración
                            </a>
                        </div>
                    </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                        <div class="p-4 bg-green-50 rounded" style="background-color:#f0fdf4;">
                            <div class="text-sm">Total de recolecciones</div>
                            <div class="text-2xl font-bold">{{ $total ?? 0 }}</div>
                        </div>
                        <div class="p-4 bg-green-50 rounded" style="background-color:#f0fdf4;">
                            <div class="text-sm">Programadas</div>
                            <div class="text-2xl font-bold">{{ $scheduled ?? 0 }}</div>
                        </div>
                        <div class="p-4 bg-green-50 rounded" style="background-color:#f0fdf4;">
                            <div class="text-sm">Completadas</div>
                            <div class="text-2xl font-bold">{{ $completed ?? 0 }}</div>
                        </div>
                        <div class="p-4 bg-green-50 rounded" style="background-color:#f0fdf4;">
                            <div class="text-sm">Kilos totales</div>
                            <div class="text-2xl font-bold">{{ $kilos ?? 0 }}</div>
                        </div>
                    </div>

                    <h4 class="mt-6 font-medium">Últimas recolecciones</h4>
                    <ul class="mt-2">
                        @forelse($recent as $r)
                            <li class="border-b py-2">
                                <a href="{{ route('collections.show', $r) }}" class="font-semibold">Solicitud #{{ $r->id }}</a>
                                — {{ $r->type }} — {{ $r->status }} — {{ $r->kilos ?? '-' }} kg
                            </li>
                        @empty
                            <li>No hay recolecciones recientes.</li>
                        @endforelse
                    </ul>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
