<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Employee;

class EmployeesWageProgression implements FromCollection, WithHeadings
{
    use Exportable;

    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    public function collection()
    {
        return $this->employees;
    }

    public function headings(): array
    {
        return[
            'id', 
            'First Name',
            'Last Name',
            'MI',
            'SSN',
            'Oracle Number',
            'Progression Date',
            'Progression Month',
            'Hire Date',
            'Cost Center',
            'Shift',
            'Job',
            'Position',
        ];
    }

}
