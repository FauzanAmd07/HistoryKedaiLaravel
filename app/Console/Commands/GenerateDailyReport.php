<?php

namespace App\Console\Commands;

use App\Models\Transaksi;
use Illuminate\Console\Command;

class GenerateDailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kedai:daily-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Summarize today sales transactions';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $count = Transaksi::whereDate('tanggal', today())->count();
        $this->info("Total transactions today: {$count}");
        return Command::SUCCESS;
    }
}
