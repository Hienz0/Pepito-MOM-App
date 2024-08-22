<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Artisan;

class RunPepitoMomApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:pepito-mom-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the Laravel server and then run the task update for Pepito MoM app in a separate terminal';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Start the Laravel server
        $this->info('Starting Laravel server...');
        $serveProcess = new Process(['php', 'artisan', 'serve']);
        $serveProcess->setTimeout(null); // Set no timeout
        $serveProcess->start();
    
        // Give the server some time to start
        usleep(2000000); // 2 seconds
    
        // Check if the server is running
        if ($serveProcess->isRunning()) {
            $this->info('Laravel server is running.');
    
            // Display the link to open the server in a browser
            $this->info('Server is available at: http://127.0.0.1:8000');
            $this->info('You can open it by Ctrl+Click on the link above.');
    
            // Run the batch file in a separate terminal
            $this->info('Running task update in a separate terminal...');
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                // For Windows
                exec('start cmd.exe /K "'.base_path('run_tasks_update.bat').'"');
            } else {
                // For MacOS/Linux
                exec('x-terminal-emulator -e '.escapeshellcmd(base_path('run_tasks_update.bat')));
            }
    
            // Keep the server running
            while ($serveProcess->isRunning()) {
                usleep(500000); // Wait for 0.5 seconds to reduce CPU usage
            }
        } else {
            $this->error('Failed to start Laravel server.');
        }
    
        return Command::SUCCESS;
    }
    
    
}
