<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CancelPendingTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:cancel-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancel pending transactions older than 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredTime = Carbon::now()->subDay();

        $transactions = Transaction::where('status', 'PENDING')
            ->where('created_at', '<', $expiredTime)
            ->get();

        $count = 0;
        foreach ($transactions as $transaction) {
            $transaction->update(['status' => 'CANCELLED']);
            $count++;
        }

        $this->info("Cancelled {$count} expired pending transactions.");
    }
}
