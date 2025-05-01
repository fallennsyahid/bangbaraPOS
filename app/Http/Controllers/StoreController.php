<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Carbon\Carbon;

class StoreController extends Controller
{
    public function toggleStatus() {
        $store = Store::first();

        $store->status = $store->status == 1 ? 0 : 1;
        $store->save();

        return redirect()->back()->with('success', 'Status toko berhasil diperbaharui');
    }

    public function checkAutoUpdateStatus() {
        $store = Store::first();
        $currentHour = Carbon::now()->format('H'); // jam format 24 jam

        if ($currentHour == 10 && $store->status != 1) {
            $store->status = 1; // buka
            $store->save();
        } elseif ($currentHour == 23 && $store->status != 0) {
            $store->status = 0; // tutup
            $store->save();
        }
    }

    }

