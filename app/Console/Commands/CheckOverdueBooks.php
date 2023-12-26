<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BookTransaction;
use App\Notifications\OverdueBookNotification;
use Carbon\Carbon;

class CheckOverdueBooks extends Command
{

    protected $signature = 'check:overdue-books';
    protected $description = 'Check for overdue books and notify users';

    public function handle()
    {
        $overdueTransactions = BookTransaction::overdue()->get();

        foreach ($overdueTransactions as $transaction) {
            $transaction->user->notify(new OverdueBookNotification($transaction));
        }

        $this->info('Overdue book check completed.');
    }
}
