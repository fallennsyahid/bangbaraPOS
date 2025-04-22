<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Collection;

class HistoriesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $histories;

   public function __construct(Collection $histories)
{
    $this->histories = $histories;
}



  public function collection()
{
   return $this->histories;
}



     public function map($history): array
    {
        $productNames = [];

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
            implode(', ', $productNames), // nama-nama menu digabung
            $history->total_price,
            $history->payment_method,
            $history->request,
            $history->payment_photo,
            $history->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Costumer',
            'Phone',
            'Orders',
            'Total',
            'Method',
            'Photo',
            'request',
            'Date',
        ];
    }
}

