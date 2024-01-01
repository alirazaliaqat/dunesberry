<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCacheCommand extends Command
{
    protected $signature = 'clear:cache';
    protected $description = 'Clear the application cache';

    public function handle()
    {
        $exitCode = \Artisan::call('cache:clear');

        $this->info('Cache cleared successfully.');

        return $exitCode;
    }
}
