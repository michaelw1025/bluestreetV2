<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Employee;
use App\Spouse;
use App\Dependant;

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

        for($i = 0; $i <= 100; $i++)
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
            $employee->hire_date = $faker->year($max = 'now').'-'.$faker->month.'-'.$faker->dayOfMonth;
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
        }
    }
}
