<?php

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use App\Employee;
use App\Disciplinary;
use App\CostCenter;

class EmployeeDisciplinarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::disableQueryLog();
      DB::table('disciplinaries')->truncate();

      $file = public_path().'/csvs/disciplinaries.csv';
      $csv = Reader::createFromPath($file, 'r');
      $csv->setHeaderOffset(0);

      $header = $csv->getHeader(); //returns the CSV header record
      $records = $csv->getRecords(); //returns all the CSV records as an Iterator object

      foreach($records as $record){
        // define variables
        $ssn = "";
        $employee = "";
        $costCenterNumber = "";
        $costCenter = "";
        $disciplinaryType = "";
        $level = "";
        $newDisciplinary = "";
        $costCenterID = "";



        // Set ssn for search
        $ssn = preg_replace('/\s+/', '', $record['ssn']);
        $ssn = preg_replace('/[^0-9]/', '', $ssn);

        // Get employee
        $employee = Employee::where('ssn', $ssn)->first();
        if(!is_null($employee)){
          $issuer = Employee::where('last_name', 'stubblefield')->first();
          // Set cost center
          if(!isset($record['cost_center'][5])){
            $costCenterNumber = "2004";
          }else{
            $costCenterNumber = substr($record['cost_center'], 0, 4);
          }
          $costCenter = CostCenter::where('number', $costCenterNumber)->first();
          if(!is_null($costCenter)){
            $costCenterID = $costCenter->id;
          }else{
            $costCenter = CostCenter::where('number', '2004')->first();
            $costCenterID = $costCenter->id;
          }
          // Set attendance disciplinary type
          if($record['attendance'] !== ""){
            $disciplinaryType = "attendance";
            if(strpos($record['attendance'], "HR") !== false){
              $level = "hr review";
            }elseif(strpos($record['attendance'], "Final") !== false){
              $level = "final";
            }elseif(strpos($record['attendance'], "2nd") !== false){
              $level = "second";
            }else{
              $level = "first";
            }
            $newDisciplinary = new Disciplinary();
            $newDisciplinary->type = $disciplinaryType;
            $newDisciplinary->level = $level;
            $newDisciplinary->date = $record['attendance_date'];
            $newDisciplinary->cost_center = $costCenter->id;
            $newDisciplinary->issued_by = $issuer->id;
            $newDisciplinary->comments = "check access";
            $employee->disciplinary()->save($newDisciplinary);
          }

          // Set performance disciplinary type
          if($record['performance'] !== ""){
            $disciplinaryType = "performance";
            if(strpos($record['performance'], "2nd Final") !== false || strpos($record['performance'], "HR Review - 2nd Final") !== false){
              $level = "2nd hr review";
            }elseif(strpos($record['performance'], "HR") !== false){
              $level = "hr review";
            }elseif(strpos($record['performance'], "Final") !== false){
              $level = "final";
            }elseif(strpos($record['performance'], "2nd") !== false){
              $level = "second";
            }else{
              $level = "first";
            }
            $newDisciplinary = new Disciplinary();
            $newDisciplinary->type = $disciplinaryType;
            $newDisciplinary->level = $level;
            $newDisciplinary->date = $record['performance_date'];
            $newDisciplinary->cost_center = $costCenter->id;
            $newDisciplinary->issued_by = $issuer->id;
            $newDisciplinary->comments = "check access";
            $employee->disciplinary()->save($newDisciplinary);
          }
        }else{

        }


      }





    }





}
