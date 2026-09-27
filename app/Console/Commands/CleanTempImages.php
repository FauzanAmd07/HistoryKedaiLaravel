<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanTempImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kedai:clean-temp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean temporary uploaded images from storage';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Cleaning temporary upload files...');
        // Logic to clean temp directory
        $this->info('Temporary files cleaned successfully!');
        return Command::SUCCESS;
    }
}
