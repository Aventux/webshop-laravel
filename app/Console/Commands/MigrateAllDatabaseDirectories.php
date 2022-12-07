<?php

namespace App\Console\Commands;

use App\Console\Commands;
use Illuminate\Console\View\Components\Info;
use Illuminate\Console\View\Components\Task;

class MigrateAllDatabaseDirectories extends Commands
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customMigrate:migrateDirectories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Directories';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        /** @var array $migrationDirectories */
        $migrationDirectories = config('custom.migrateDirectories');
        $migrationDirectoriesCount = count($migrationDirectories);

        $this->write(Info::class, 'Migrate Directories ('.$migrationDirectoriesCount.')');
        $migrationDirectoriesCounter = 0;

        foreach ($migrationDirectories as $directory) {
            $migrationDirectoriesCounter++;

            $this->write(Info::class,
                'Migrating Directory: '.$directory.' ('.$migrationDirectoriesCounter.'/'.$migrationDirectoriesCount.')');

            $this->write(Task::class, 'Migrating: '.$directory, function () use ($directory) {
                $this->call('migrate', [
                    '--force' => true, '--path' => $directory,
                ]);
            });
        }

        return 0;
    }
}
