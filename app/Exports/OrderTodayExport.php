<?php

namespace App\Exports;

use App\Models\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderTodayExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::whereDate('created_at', Carbon::today())->get();
    }

    /**
     * Return the headings for the exported file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Phone',
            'Status',
            'Totals',
            'Photo',
            'Method',
            'Request',
            'Orders',
            'Created At',
            'Updated At'
        ];
    }
}
