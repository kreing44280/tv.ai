<?php

namespace App\Console\Commands;

use App\Console\Kernel;
use Illuminate\Console\Command;

class UpdateDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-data-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(Kernel::class)->dashboard();
        app(Kernel::class)->sumNewsContent();
        app(Kernel::class)->newsCount();
        app(Kernel::class)->videoDuration();
    }
}
