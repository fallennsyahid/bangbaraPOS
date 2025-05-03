<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Store;

class AutoToggleStoreStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:toggle-store-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Toggle store status automatically based on time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $store = Store::first();

        // Jika ada override manual, tidak mengubah status
        if (!$store || $store->manual_override) {
        return;
        }

        $now = now()->format('H:i');

        if ($now === '10:00') {
        $store->status = 1; // buka
        $store->save();
    } 
        elseif ($now === '20:10') {
        $store->status = 0; // tutup
        $store->save();
    }

    }
}
