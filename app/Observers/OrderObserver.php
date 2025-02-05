<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\History;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        if ($order->status === 'Completed' || $order->status === 'Cancelled') {
        History::create([
            'customer_name' => $order->customer_name,
            'customer_phone' => $order->customer_phone,
            'product_id' => $order->product_id,
            'quantity' => $order->quantity,
            'total_price' => $order->total_price,
            'payment_photo' => $order->payment_photo,
            'payment_method' => $order->payment_method,
            'request' => $order->request,
            'status' => $order->status,
        ]);
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        $order->delete();
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
