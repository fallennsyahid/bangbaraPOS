<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;

class StatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $statusCounts;

    public function __construct($statusCounts)
    {
        $this->statusCounts = $statusCounts;
    }

    public function broadcastWith()
    {
        return ['statusCounts' => $this->statusCounts];
    }

    public function broadcastOn(): array
    {
        return
        [
         new Channel('order-status'),
        ]; // channel publik
    }

    public function broadcastAs()
    {
        return 'new-status';
    }
}
