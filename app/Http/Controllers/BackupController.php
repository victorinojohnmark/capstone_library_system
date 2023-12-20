<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Artisan;
use Spatie\Backup\BackupDestination\Backup;
use Spatie\Backup\BackupDestination\BackupDestination;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{

    public function index()
    {
        return view('system.backup.backupview', [
            
        ]);
    }

    public function createBackup()
    {
        try {
            // Run the backup command
        Artisan::call('backup:run');

        // Get the disk instance
        $disk = Storage::disk('public');

        // Check if directory exist
        if ($disk->exists(env('APP_NAME'))) {
            // Get the list of files in the directory
            $files = $disk->files(env('APP_NAME'));

            // Get the latest file without sorting the array
            $latestFile = end($files);

            // Check if the latest file exists
            if ($disk->exists($latestFile)) {
                // Download the latest backup file
                return $disk->download($latestFile);
            } else {
                return redirect()->back()->with('error', 'Backup file does not exist.');
            }
        } else {
            // Directory does not exist
            return redirect()->back()->with('error', 'Backup Directory file does not exist.');
        }
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
       
    }

    public function getBackupFiles()
    {
        // Specify the directory path
        $directory = 'ASHI LMS';

        // Get the disk instance
        $disk = Storage::disk('public');

        // Check if the directory exists
        if ($disk->exists($directory)) {
            // Get the list of files in the directory
            $files = $disk->files($directory);

            // Process each file
            foreach ($files as $file) {
                // Perform actions with each file, for example, display the file name
                echo "File: $file\n";
            }

            // You can also return the list of files if needed
            return $files;
        } else {
            // Directory does not exist
            echo "Directory '$directory' does not exist.\n";
            return [];
        }
    }
}
