<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class makeService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {serviceName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a service class in the \App\Services\ directory';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
