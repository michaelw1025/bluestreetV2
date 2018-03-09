<?php

use Illuminate\Database\Seeder;
use App\DentalPlan;

class DentalPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dental1 = new DentalPlan();
        $dental1->description = 'enrolled';
        $dental1->save();
        $dental1->insuranceCoverage()->sync([
            1 => ['amount' => 2.03], 
            2 => ['amount' => 4.26], 
            3 => ['amount' => 3.75], 
            4 => ['amount' => 6.59],
        ]);
    }
}
