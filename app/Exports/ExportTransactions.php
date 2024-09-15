<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExportTransactions implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'Peminjam', 'Kendaraan', 'Supir', 'Dari', 'Sampai'
        ];
    }
    public function collection()
    {
        $readyToExport = DB::select("select Transactions.employee_name, CONCAT(v.type,' | ',v.name) as kendaraan, d.name, Transactions.start_date, Transactions.end_date from Transactions join vehicles v on (Transactions.vehicle_id = v.id) join drivers d on (Transactions.driver_id = d.id) where Transactions.approved_man = \"1\" and Transactions.approved_spv = \"1\" and start_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR) order by start_date;");
        return collect($readyToExport);
    }
}
