<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;
use App\Employee;

class EmployeesTableSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'employees';
        $this->filename = base_path().'/database/seeds/employee-seed.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}
