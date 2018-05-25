<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Employee;
use App\Spouse;
use App\Dependant;
use App\PhoneNumber;
use App\EmergencyContact;
use App\Position;
use App\Job;
use App\CostCenter;
use App\Shift;
use App\Termination;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $hourly = Job::where('description', 'hourly')->first();
        $salary = Job::where('description', 'salary')->first();

        $hourlyPositionsArray = array('assembler',
            'checmical floor support technician',
            'floor support technician',
            'machine operator component',
            'machine operator scroll',
            'material handler',
            'production quality auditor',
            'support documentation',
            'specialist guage',
            'specialist iso',
            'specialist maintenance',
            'specialist manufacturing',
            'specialist operations',
            'specialist teardown',
            'specialist welding',
            'machinist',
            'maintenance assemly',
            'maintenance component',
            'maintenance facilities', 
            'maintenance scroll', 
            'maintenance leader',
        );

        $salaryPositionsArray = array(
            'administrative assistant',
            'administrator it lan sr',
            'analyst financial',
            'analyst it',
            'analyst materials',
            'clerk payroll',
            'college student',
            'controller plant', 
            'controller plant assistant',
            'coordinator engineering change',
            'coordinator hr',
            'coordinator project administrative',
            'engineer environmental',
            'engineer industrial',
            'engineer lead',
            'engineer manufacturing',
            'engineer manufacturing sr',
            'engineer production',
            'engineer quality',
            'generalist hr',
            'manager employee relations',
            'manager facilities and maintenance',
            'manager hr',
            'manager manufacturing services',
            'manager materials',
            'manager operations',
            'manager quality',
            'manager team',
            'manager technical team',
            'materials coordinator',
            'project leader materials',
            'scheduler',
            'supervisor materials',
            'team leader assembly',
            'team leader iso and quality systems',
            'team leader machining',
            'team leader materials',
            'team leader quality',
            'technician calorimeter',
            'technician project'
        );

        $costCenterArray = array(
            '2000',
            '1000',
            '2001',
            '2003',
            '2006',
            '2009',
            '2004',
            '2010',
            '2011',
            '2015',
            '2013',
            '2014',
            '3020',
            '3100',
            '3106',
            '3200',
            '3287',
            '3281',
            '3201',
            '3202',
            '3203',
            '3204',
            '3205',
            '3206',
            '3207',
            '3208',
            '3209',
            '3210',
            '3010',
            '3400',
            '3401',
            '3411',
            '3301',
            '3431',
            '3402',
            '3412',
            '3432',
            '3501',
            '3502',
            '3510',
            '3437',
            '3440',
            '3504',
            '3503',
            '3404',
            '3414',
            '3424',
            '3405',
            '3415',
            '3425',
            '3417',
            '3008',
            '3009',
            '3003',
            '3001',
            '3438',
            '3002',
            '3439',
            '3013',
            '3016',
            '3018',
            '3000',
            '3406',
        );

        $shiftsArray = array('day', 'night');

        for($i = 0; $i <= 25; $i++)
        {
            $employee = new Employee();

            $firstName = $faker->randomElement($array = array('null', 'male', 'female'));
            $middle = $faker->text($maxNbChars = 5);

            $employee->first_name = $faker->firstName($gender = $firstName);
            $employee->middle_initial = $middle[0];
            $employee->last_name = $faker->lastName;
            $employee->ssn = $faker->ssn;
            $employee->oracle_number = $faker->randomNumber($nbDigits = 6, $strict = false);
            $employee->birth_date = $faker->year($max = 'now').'-'.$faker->month.'-'.$faker->dayOfMonth;
            // $employee->hire_date = $faker->year($max = 'now').'-'.$faker->month.'-'.$faker->dayOfMonth;
            $year = rand(1990, 2018);
            $employee->hire_date = Carbon::create($year, $faker->month, $faker->dayOfMonth, 0, 0, 0);
            $employee->service_date = $faker->year($max = 'now').'-'.$faker->month.'-'.$faker->dayOfMonth;
            if($firstName == 'female'){
                $employee->maiden_name = $faker->lastName;
            }else{
                $employee->maiden_name = null;
            }
            $employee->nick_name = $faker->randomElement($array = array($faker->firstName($gender = $firstName)));
            $employee->gender = $faker->randomElement($array = array('male', 'female'));
            $employee->suffix = $faker->randomElement($array = array('null', 'mr', 'miss', 'mrs'));
            $employee->address_1 = $faker->streetAddress;
            $employee->address_2 = $faker->randomElement($array = array('null', $faker->secondaryAddress));
            $employee->city = $faker->city;
            $employee->state = $faker->stateAbbr;
            $employee->zip_code = $faker->postcode;
            $employee->county = $faker->city;
            $employee->status = $faker->numberBetween($min = 0, $max = 1);
            $employee->rehire = $faker->numberBetween($min = 0, $max = 1);
            $employee->bid_eligible = $faker->numberBetween($min = 0, $max = 1);
            $employee->bid_eligible_date = $faker->year($max = 'now').'-'.$faker->month.'-'.$faker->dayOfMonth;
            $employee->bid_eligible_comment = $faker->realText($maxNbChars = 40, $indexSize = 1);
            $employee->thirty_day_review = $faker->numberBetween($min = 0, $max = 1);
            $employee->sixty_day_review = $faker->numberBetween($min = 0, $max = 1);


            $employee->save();

            $spouseRandom = $faker->numberBetween($min = 0, $max = 1);
            if($spouseRandom == 1){
                $spouse = new Spouse();
                if($firstName = 'male'){
                    $spouse->first_name = $faker->firstName($gender = 'female');
                }elseif($firstName = 'female'){
                    $spouse->first_name = $faker->firstName($gender = 'male');
                }else{
                    $spouse->first_name = $faker->firstName($gender = 'male');
                }
                $spouse->last_name = $employee->last_name;
                $middle = $faker->text($maxNbChars = 5);
                $spouse->middle_initial = $middle[0];
                $spouseSSN = $faker->ssn;
                $spouse->ssn = str_replace('-', '', $spouseSSN);
                $spouse->birth_date = $faker->year($max = 'now').'-'.$faker->month.'-'.$faker->dayOfMonth;
                if($employee->gender == 'male'){
                    $spouse->gender = 'female';
                }else{
                    $spouse->gender = 'male';
                }
                $domesticPartnerRandom = $faker->numberBetween($min = 0, $max = 1);
                if($domesticPartnerRandom == 0){
                    $spouse->domestic_partner = 0;
                }else{
                    $spouse->domestic_partner = 1;
                }
                $employee->spouse()->save($spouse);
            }

            $dependantRandom = $faker->numberBetween($min = 0, $max = 5);
            for($d = 0; $d < $dependantRandom; $d++){
                $dependant = new Dependant();
                $dependantNameType = $faker->randomElement($array = array('null', 'male', 'female'));
                $dependant->first_name = $faker->firstName($gender = $dependantNameType);
                $dependant->last_name = $employee->last_name;
                $middle = $faker->text($maxNbChars = 5);
                $dependant->middle_initial = $middle[0];
                $dependantSSN = $faker->ssn;
                $dependant->ssn = str_replace('-', '', $dependantSSN);
                $dependant->birth_date = $faker->year($max = 'now').'-'.$faker->month.'-'.$faker->dayOfMonth;
                if($dependantNameType == 'male'){
                    $dependant->gender = 'male';
                }else{
                    $dependant->gender = 'female';
                }
                $employee->dependant()->save($dependant);
            }

            $phoneRandom = $faker->numberBetween($min = 0, $max = 2);
            for($c = 0; $c <= $phoneRandom; $c++){
                $phone = new PhoneNumber();
                $phone->number =$faker->randomNumber($nbDigits = 5, $strict = false).$faker->randomNumber($nbDigits = 5, $strict = false);
                if($c == 0){
                    $phone->is_primary = 1;
                }else{
                    $phone->is_primary = 0;
                }
                $employee->phoneNumber()->save($phone);
            }

            $contactRandom = $faker->numberBetween($min = 0, $max = 3);
            for($c = 0; $c <= $contactRandom; $c++){
                $contact = new EmergencyContact();
                $contact->name = $faker->firstName.' '.$faker->lastName;
                $contact->number = $faker->randomNumber($nbDigits = 5, $strict = false).$faker->randomNumber($nbDigits = 5, $strict = false);
                if($c == 0){
                    $contact->is_primary = 1;
                }else{
                    $contact->is_primary = 0;
                }
                $employee->emergencyContact()->save($contact);
            }

            $employeeJob = $faker->randomElement($array = array($hourly, $salary));
            $employee->job()->sync([$employeeJob->id]);

            if($employeeJob == $hourly){
                $positionTitle = $faker->randomElement($array = $hourlyPositionsArray);
                $positionInfo = Position::where('description', $positionTitle)->first();
                $employee->position()->sync($positionInfo->id);
            }else{
                $positionTitle = $faker->randomElement($array = $salaryPositionsArray);
                $positionInfo = Position::where('description', $positionTitle)->first();
                $employee->position()->sync($positionInfo->id);
            }

            $costCenterTitle = $faker->randomElement($array = $costCenterArray);
            $costCenter = CostCenter::where('number', $costCenterTitle)->first();
            $employee->costCenter()->sync($costCenter->id);

            $shiftTitle = $faker->randomElement($array = $shiftsArray);
            $shiftInfo = Shift::where('description', $shiftTitle)->first();
            $employee->shift()->sync($shiftInfo->id);

            if($employee->status == 0){
                $termination = new Termination();
                $termination->type = $faker->randomElement($array = array('volunatary', 'involuntary'));
                $termination->date = $faker->year($max = 'now').'-'.$faker->month.'-'.$faker->dayOfMonth;
                $termination->last_day = $faker->year($max = 'now').'-'.$faker->month.'-'.$faker->dayOfMonth;
                $termination->comments = $faker->text($maxNbChars = 100);
                $employee->termination()->save($termination);
            }

        }
    }
}
