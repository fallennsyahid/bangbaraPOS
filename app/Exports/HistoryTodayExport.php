<?php

namespace App\Exports;

use App\Models\History;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HistoryTodayExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
{
    return History::whereDate('created_at', Carbon::today())->get()
        ->map(function ($history) {
            $productNames = [];

                // Pastikan products tidak null dan berbentuk JSON yang valid
                if (!empty($history->products)) {
                $products = json_decode(json_decode($history->products, true), true);

                if (is_array($products)) {
                    foreach ($products as $product) {
                        if (isset($product['nama_menu'])) {
                            $productNames[] = $product['nama_menu'];
                        }
                    }
                }
            }

            return [
                $history->id,
                $history->customer_name,
                $history->customer_phone,
                implode(', ', $productNames), // gabungkan semua nama menu
                $history->status,
                $history->total_price,
                $history->payment_method,
                $history->request,
                $history->created_at,
            ];
        });
}

    /**
     * Return the headings for the exported file.
     *
     * @return array
     */
    public function headings(): array
    {
        // Headings saat di excel nya
        return ['ID', 'Costumer Name', 'Phone', 'Product Name', 'Status', 'Total Price', 'Method', 'Request', 'Created At'];
    }
}
