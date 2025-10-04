<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Collection;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $total = $user->collections()->count();
        $scheduled = $user->collections()->where('status', 'scheduled')->count();
        $completed = $user->collections()->where('status', 'completed')->count();
        $kilos = $user->collections()->whereNotNull('kilos')->sum('kilos');
        $recent = $user->collections()->latest()->limit(5)->get();

        return view('dashboard', compact('total', 'scheduled', 'completed', 'kilos', 'recent'));
    }
}
