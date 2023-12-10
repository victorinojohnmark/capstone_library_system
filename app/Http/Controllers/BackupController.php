<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;

class BackupController extends Controller
{

    public function index()
    {
        return view('system.backup.backupview', [
            
        ]);
    }

    public function createBackup()
    {
        $name = '1';

        Artisan::call('snapshot:create', ['name' => $name]);

        // Get the path to the created snapshot file
        $pathToFile = storage_path("app/db-snapshots/{$name}.sql");

        // Provide the dumped file as a download response
        return Response::download($pathToFile)->deleteFileAfterSend(true);

        // Create the snapshot using the db-snapshots package
        // $createCommand = new Create(new DbSnapshots());
        // $createCommand->handle($name);

        // // Get the path to the created snapshot file
        // $pathToFile = storage_path("app/public/databases/{$name}.sql");

        // // Provide the dumped file as a download response
        // return Response::download($pathToFile)->deleteFileAfterSend(true);

        // Run the backup job
        // $backupJob = BackupJobFactory::createFromArray(config('backup'));
        // $backupJob->disableSignals();
        // $backupJob->run();

        // Download the backup file
        // return response()->download($backupJob->getDestinationFile());
        // Artisan::call('snapshot:create first-dump');
        // return Artisan::output();

        // Set your database credentials
        // $databaseName = env('DB_DATABASE');
        // $userName = env('DB_USERNAME');
        // $password = env('DB_PASSWORD');

        // // Set the path where the dump file will be stored
        // $pathToFile = storage_path('app/public/backups/database-dump.sql');

        // // Dump the database to a file
        // MySql::create()
        //     ->setDbName($databaseName)
        //     ->setUserName($userName)
        //     ->setPassword($password)
        //     ->dumpToFile($pathToFile);

        // // Provide the dumped file as a download response
        // return Response::download($pathToFile, 'database-dump.sql')->deleteFileAfterSend(true);
    }
}
