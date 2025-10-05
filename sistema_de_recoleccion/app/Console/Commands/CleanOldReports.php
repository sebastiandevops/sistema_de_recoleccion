<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CleanOldReports extends Command
{
    protected $signature = 'reports:clean {--days=30 : Number of days to keep reports}';

    protected $description = 'Delete reports older than N days from storage/app/reports';

    public function handle()
    {
        $days = (int) $this->option('days');
        $cutoff = Carbon::now()->subDays($days)->timestamp;

        $files = Storage::files('reports');
        $deleted = 0;
        foreach ($files as $file) {
            if (Storage::lastModified($file) < $cutoff) {
                Storage::delete($file);
                $deleted++;
            }
        }

        $this->info("Deleted {$deleted} report(s) older than {$days} day(s).");
        return 0;
    }
}
