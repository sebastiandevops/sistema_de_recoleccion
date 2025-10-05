<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollectionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $collections = $user->collections()->latest()->paginate(10);
        return view('collections.index', compact('collections'));
    }

    public function create()
    {
        return view('collections.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string',
            'mode' => 'nullable|string',
            'frequency' => 'nullable|integer',
            'scheduled_at' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $data['user_id'] = Auth::id();
        $collection = Collection::create($data);

        return redirect()->route('collections.index')->with('success', 'Solicitud registrada.');
    }

    public function show(Collection $collection)
    {
        $this->authorize('view', $collection);
        return view('collections.show', compact('collection'));
    }

    public function edit(Collection $collection)
    {
        $this->authorize('update', $collection);
        return view('collections.edit', compact('collection'));
    }

    public function update(Request $request, Collection $collection)
    {
        $this->authorize('update', $collection);
        $data = $request->validate([
            'type' => 'required|string',
            'mode' => 'nullable|string',
            'frequency' => 'nullable|integer',
            'scheduled_at' => 'nullable|date',
            'notes' => 'nullable|string',
            'status' => 'nullable|string',
            'kilos' => 'nullable|numeric',
        ]);
        $collection->update($data);
        return redirect()->route('collections.index')->with('success', 'Solicitud actualizada.');
    }

    public function destroy(Collection $collection)
    {
        $this->authorize('delete', $collection);
        $collection->delete();
        return redirect()->route('collections.index')->with('success', 'Solicitud eliminada.');
    }

    // Cancel a scheduled collection (soft state change)
    public function cancel(Collection $collection)
    {
        $this->authorize('update', $collection);

        // Only allow cancelling if currently scheduled
        if ($collection->status !== 'scheduled') {
            return redirect()->route('collections.index')->with('error', 'Solo se pueden cancelar recolecciones programadas.');
        }

        $collection->status = 'cancelled';
        $collection->save();

        return redirect()->route('collections.index')->with('success', 'Recolección cancelada.');
    }
}
