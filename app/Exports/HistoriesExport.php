<?php

namespace App\Exports;

use App\Models\History;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HistoriesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct(Request $request)
    {
        $this->filters = [
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),

        ];
    }

    public function collection()
    {
        $query = History::query();

        // Filter berdasarkan parameter
       if (!empty($this->filters['start_date']) && !empty($this->filters['end_date'])) {
            $query->whereBetween('created_at', [$this->filters['start_date'], $this->filters['end_date']]);
        } elseif (!empty($this->filters['start_date'])) {
            $query->where('created_at', '>=', $this->filters['start_date']);
        } elseif (!empty($this->filters['end_date'])) {
            $query->where('created_at', '<=', $this->filters['end_date']);
        }

        return $query->with('product')->get();
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

