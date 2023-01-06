<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new database from existing database name in env file';

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
