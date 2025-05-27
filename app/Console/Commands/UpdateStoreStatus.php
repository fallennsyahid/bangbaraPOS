<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UpdateStoreStatus extends Command
{
    protected $signature = 'update:store-status';
    protected $description = 'Perbarui status buka/tutup toko berdasarkan waktu';

    
    public function handle()
    {
        $now = Carbon::now('Asia/Jakarta');
        $openTime = Carbon::createFromTimeString('09:00', 'Asia/Jakarta');
        $closeTime = Carbon::createFromTimeString('23:00', 'Asia/Jakarta');

        $shouldBeOpen = $now->between($openTime, $closeTime);

        DB::table('stores')->where('id', 1)->update([
            'status' => $shouldBeOpen ? 1 : 0,
            'updated_at' => now()
        ]);

        $this->info('Status toko: ' . ($shouldBeOpen ? 'BUKA' : 'TUTUP'));
    }
}
