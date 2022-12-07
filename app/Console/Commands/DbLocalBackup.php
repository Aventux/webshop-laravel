<?php

namespace App\Console\Commands;

use App\Console\Commands;
use Illuminate\Console\View\Components\Error;
use Illuminate\Console\View\Components\Task;
use Symfony\Component\Process\Process;

class DbLocalBackup extends Commands
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:dbLocalBackup';

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
        $this->write(Task::class, 'Local Database Backup', [$this, 'backup']);

        return 0;
    }

    public function backup(): bool
    {
        $process = new Process([
            'scripts/localBackupRestore/dbLocalBackup.sh', env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'),
            storage_path('dbdump/local.sql.gz'),
        ]);
        $process->run();
        if ($process->getExitCode()) {
            $this->write(Error::class, $process->getErrorOutput());

            return false;
        }

        return true;
    }
}
