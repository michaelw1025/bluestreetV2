<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Employee;

class WageExport implements FromCollection
{
    public function collection()
    {
        return Employee::all();
    }

}