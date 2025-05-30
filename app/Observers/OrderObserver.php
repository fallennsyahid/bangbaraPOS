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
                'order_id' => $order->order_id,
                'casier_name' => $order->casier_name,
                'customer_name' => $order->customer_name,
                'customer_phone' => $order->customer_phone,
                'total_price' => $order->total_price,
                'payment_method' => $order->payment_method,
                'request' => $order->request,
                'status' => $order->status,
                'serve_option' => $order->serve_option,
                'products' => json_encode($order->products),
            ]);
        }
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
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
