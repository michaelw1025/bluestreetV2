<?php

use Illuminate\Database\Seeder;
use App\AccidentalCoverage;

class AccidentalCoveragesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coverage1 = new AccidentalCoverage();
        $coverage1->description = 'employee only';
        $coverage1->save();

        $coverage4 = new AccidentalCoverage();
        $coverage4->description = 'family';
        $coverage4->save();
    }
}
