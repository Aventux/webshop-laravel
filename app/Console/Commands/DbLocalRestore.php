<?php

namespace App\Console\Commands;

use App\Console\Commands;
use Illuminate\Console\View\Components\Error;
use Illuminate\Console\View\Components\Task;
use Symfony\Component\Process\Process;

class DbLocalRestore extends Commands
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dbLocalRestore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup Local DB';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->write(Task::class, 'Local Database Restore', [$this, 'restore']);

        return 0;
    }

    public function restore(): bool
    {
        $process = new Process([
            'scripts/localBackupRestore/dbLocalRestore.sh', storage_path('dbdump/local.sql.gz'), env('DB_HOST'), env('DB_USERNAME'),
            env('DB_PASSWORD'), env('DB_DATABASE'),
        ]);
        $process->run();
        if ($process->getExitCode()) {
            $this->write(Error::class, $process->getErrorOutput());

            return false;
        }

        return true;
    }
}
