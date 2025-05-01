<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
     * Mendapatkan data yang akan diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil semua produk dari database
        return User::all(['id', 'name', 'email', 'usertype', 'phone_number', 'address', 'created_at']);
       
    }

    /**
     * Menentukan judul kolom di Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        // Headings saat di excel nya
        return ['ID', 'Name', 'Email', 'Role', 'Phone', 'Address', 'Since'];
    }
}
