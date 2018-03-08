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
    }
}
