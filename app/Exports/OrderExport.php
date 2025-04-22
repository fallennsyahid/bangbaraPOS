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
    return Order::get()
        ->map(function ($order) {
            $productNames = [];

            // Pastikan products tidak null dan berbentuk JSON yang valid
            if (!empty($order->products)) {
                $products = json_decode($order->products, true);

                // Cek jika berhasil di-decode dan berbentuk array
                if (is_array($products)) {
                    foreach ($products as $product) {
                        if (isset($product['nama_menu'])) {
                            $productNames[] = $product['nama_menu'];
                        }
                    }
                }
            }

            return [
                $order->id,
                $order->customer_name,
                $order->customer_phone,
                implode(', ', $productNames), // gabungkan semua nama menu
                $order->status,
                $order->total_price,
                $order->payment_method,
                $order->request,
                $order->created_at,
            ];
        });
}


    /**
     * Menentukan judul kolom di Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        // Headings saat di excel nya
        return ['ID', 'Costumer Name', 'Customer Name', 'Product Name', 'QTY', 'Status', 'total_price', 'Payment Method', 'Request', 'Created At'];
    }
}
