<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrdersTable extends Component
{
    protected $listeners = ['orderCreated' => '$refresh'];

    public function render()
    {
        return view('livewire.orders-table', [
            'orders' => Order::orderBy('created_at', 'DESC')->get()
        ]);
    }
}



