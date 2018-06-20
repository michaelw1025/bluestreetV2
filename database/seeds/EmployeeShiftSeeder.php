<?php

use Illuminate\Database\Seeder;
use App\Employee;
use App\Shift;
use League\Csv\Reader;

class EmployeeShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        $file = public_path().'/csvs/employees-import.csv';
        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0);

        $header = $csv->getHeader(); //returns the CSV header record
        $records = $csv->getRecords(); //returns all the CSV records as an Iterator object

        foreach($records as $record){
          $checkSSN = preg_replace('/[^0-9]/', '', $record['ssn']);
          $employee = Employee::where('ssn', $checkSSN)->first();
          if($record['shift'] == '1' || $record['shift'] == 'A'){
            $shiftID = 1;
          }else{
            $shiftID = 2;
          }
          if($employee){
            $employee->shift()->sync($shiftID);
          }

        }
    }
}
