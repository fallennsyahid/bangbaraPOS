<?php

namespace App\Exports;

use App\Models\History;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
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
        return [
            $history->id,
            $history->customer_name,
            $history->customer_phone,
            isset($history->product) ? implode(', ', $history->product->pluck('nama_menu')->toArray()) : '-',
            $history->quantity,
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
            'QTY',
            'Total',
            'Method',
            'Photo',
            'request',
            'Date',
        ];
    }
}

