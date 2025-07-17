<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:mysql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the MySQL database and store it locally';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = 'backup-' . Carbon::now()->format('Y-m-d_H-i-s') . '.sql';
        $path = storage_path('app/backups/' . $filename);
        $filePath = "{$path}";

        // Ensure backup directory exists
        if (!is_dir(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0777, true);
        }

        $db = config('database.connections.mysql');
        $command = "mysqldump --user={$db['username']} --password={$db['password']} --host={$db['host']} {$db['database']} > {$path}";

        $mysqldump = 'C:\xampp8.2.4\mysql\bin\mysqldump.exe'; // escape backslashes
        $command = "$mysqldump --user={$db['username']} --password={$db['password']} --host={$db['host']} {$db['database']} > {$path}";

        $returnVar = null;
        $output = null;
        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $this->info("Backup created: {$filename}");

            $this->info("Backup stored at: {$path}");
            $this->info("Backup completed successfully!");

            $gitPath = base_path(); // Make sure .git exists here
            $relativePath = str_replace(base_path() . DIRECTORY_SEPARATOR, '', $filePath);

            $this->info("Committing to Git...");
            exec("cd {$gitPath} && git pull");
            exec("cd {$gitPath} && git add {$relativePath}");
            exec("cd {$gitPath} && git commit -m \"DB backup: {$filename}\"");
            exec("cd {$gitPath} && git push origin main"); // Or your branch

            $this->info("Backup pushed to GitHub!");


        } else {
            $this->error("Backup failed!");
        }
    }
}
