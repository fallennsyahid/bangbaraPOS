<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class OrderExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::with('products:id,nama_menu')
        ->get()
        ->map(function ($order) {
            return [
                 $order->id,
                $order->customer_name,
                $order->customer_phone,
                $order->products->nama_menu ?? 'No Product', // Nama produk
                $order->quantity,
                $order->status,
                $order->total_price,
                $order->payment_method,
                $order->created_at,
            ];
        })
        ;
    }

    /**
     * Menentukan judul kolom di Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        // Headings saat di excel nya
        return ['ID', 'Costumer Name', 'Customer Name', 'Product Name', 'QTY', 'Status', 'total_price', 'Payment Method', 'Created At'];
    }
}
