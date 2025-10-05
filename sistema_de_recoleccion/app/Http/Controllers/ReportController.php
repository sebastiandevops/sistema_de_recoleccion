<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Collection;

class ReportController extends Controller
{
    // List available reports and show button to generate new
    public function index(Request $request)
    {
        $files = Storage::files('reports');
        // sort by newest
        usort($files, function ($a, $b) {
            return Storage::lastModified($b) <=> Storage::lastModified($a);
        });

        $reports = array_map(function ($path) {
            return [
                'path' => $path,
                'name' => basename($path),
                'url' => Storage::url($path),
                'modified' => date('Y-m-d H:i:s', Storage::lastModified($path)),
            ];
        }, $files);

        return view('reports.index', compact('reports'));
    }

    // Generate a CSV report with the authenticated user's collections
    public function store(Request $request)
    {
        $user = $request->user();
        $collections = Collection::where('user_id', $user->id)->get();

        $filename = 'report_collections_' . now()->format('Ymd_His') . '.csv';
        $path = storage_path('app/reports/' . $filename);

        // ensure directory exists
        if (!file_exists(storage_path('app/reports'))) {
            mkdir(storage_path('app/reports'), 0755, true);
        }

        $fp = fopen($path, 'w');
        // header
        fputcsv($fp, ['id', 'type', 'mode', 'frequency', 'scheduled_at', 'kilos', 'status', 'notes', 'created_at']);

        foreach ($collections as $c) {
            fputcsv($fp, [
                $c->id,
                $c->type,
                $c->mode,
                $c->frequency,
                optional($c->scheduled_at)->format('Y-m-d H:i:s'),
                $c->kilos,
                $c->status,
                $c->notes,
                $c->created_at,
            ]);
        }

        fclose($fp);

        // Store using Storage facade so disks are respected (move file into storage/app/reports)
        Storage::putFileAs('reports', $path, $filename);

        // remove temp path (since putFileAs copied it)
        @unlink($path);

        return redirect()->route('reports.index')->with('status', 'report-generated');
    }

    // Download an existing report
    public function download($filename)
    {
        $path = 'reports/' . $filename;
        if (!Storage::exists($path)) {
            abort(404);
        }
        return Storage::download($path, $filename);
    }
}
