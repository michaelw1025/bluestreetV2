<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Employee;

class EmployeesBonusHours implements FromCollection, WithHeadings
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
            'Maiden Name',
            'Nick Name',
            'Gender',
            'Suffix',
            'Address 1',
            'Address 2',
            'City',
            'State',
            'Zip Code',
            'County',
            'Bonus Year',
            'Date of Birth',
            'Hire Date',
            'Service Date',
            'Cost Center',
            'Team Manager',
            'Team Leader',
            'Shift',
            'Position',
            'Job',
        ];
    }

}
