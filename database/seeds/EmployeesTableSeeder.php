<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Employee;

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

            $firstName = $faker->randomElement($array = array('male', 'female'));
            $middle = $faker->text($maxNbChars = 5);

            $employee->first_name = $faker->firstName($gender = $firstName);
            $employee->middle_initial = $middle[0];
            $employee->last_name = $faker->lastName;
            $employee->ssn = $faker->ssn;

            $employee->save();
        }
    }
}
