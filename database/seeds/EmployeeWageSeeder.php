<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Employee;
use App\WageProgression;
use App\WageProgressionWageTitle;

class EmployeeWageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $employees = Employee::with('job.wageTitle')->get();
        foreach($employees as $employee){
            $wageProgressionID = $faker->numberBetween($min = 1, $max = 15);
            $wageTitleID = $employee->job[0]->wageTitle[0]->id;
            $employeeWage = WageProgressionWageTitle::where([
                ['wage_title_id', $wageTitleID],
                ['wage_progression_id', $wageProgressionID],
            ])->first();
            
            $employee->wageProgressionWageTitle()->sync($employeeWage->id);
        }



        // Set wage events
        $wageProgressions = WageProgression::all();
        foreach($employees as $employee){
            $eventArray = array();
            $wageYear = rand(2015, 2018);
            $startWageDate = Carbon::create($wageYear, $faker->month, $faker->dayOfMonth, 0, 0, 0);
            $newDate = '';
            foreach($wageProgressions as $wageProgression){
                $newDate = $startWageDate->copy()->addMonths(3);
                $startWageDate = $newDate;
                $eventArray[$wageProgression->id] = (['date' => $newDate]);
            }
            $employee->wageProgression()->sync($eventArray);
        }
    }
}
