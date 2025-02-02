<?php

namespace App\Exports;

use App\Models\History;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class HistoriesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = [
            'filter_year' => $filters['filter_year'] ?? null,
            'filter_month' => $filters['filter_month'] ?? null,
            'filter_day' => $filters['filter_day'] ?? null,
        ];
    }

    public function collection()
    {
        $query = History::query();

        // Filter berdasarkan parameter
        if ($this->filters['filter_year']) {
            $query->whereYear('created_at', $this->filters['filter_year']);
        }
        if ($this->filters['filter_month']) {
            $query->whereMonth('created_at', $this->filters['filter_month']);
        }
        if ($this->filters['filter_day']) {
            $query->whereDay('created_at', $this->filters['filter_day']);
        }

        return $query->get();
    }

    public function map($history): array
    {
        return [
            $history->id,
            $history->customer_name,
            $history->customer_phone,
            $history->products->nama_menu,
            $history->quantity,
            $history->total_price,
            $history->payment_method,
            $history->request,
            $history->payment_photo,
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
            'request'
        ];
    }
}

