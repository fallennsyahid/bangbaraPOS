<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Store;
use Carbon\Carbon;

class UpdateStoreStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:check-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update store status automatically at 10 AM and 9 PM';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $store = Store::first();
        $time = Carbon::now()->format('H:i');

        if ($time === '10:00' && $store->status != 1) {
            $store->status = 1; // buka
            $store->save();
            $this->info('Store opened at 10 AM');
        } elseif ($time == '21:00' && $store->status != 0) {
            $store->status = 0; // tutup
            $store->save();
            $this->info('Store closed at 9 PM');
        } else {
            $this->info('No status change needed at this hour (' . $time . ')');
        }
    }
}
