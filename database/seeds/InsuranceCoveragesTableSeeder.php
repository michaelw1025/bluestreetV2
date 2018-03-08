<?php

use Illuminate\Database\Seeder;
use App\InsuranceCoverage;

class InsuranceCoveragesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coverage1 = new InsuranceCoverage();
        $coverage1->description = 'employee only';
        $coverage1->save();

        $coverage2 = new InsuranceCoverage();
        $coverage2->description = 'employee + spouse';
        $coverage2->save();

        $coverage3 = new InsuranceCoverage();
        $coverage3->description = 'employee + children';
        $coverage3->save();

        $coverage4 = new InsuranceCoverage();
        $coverage4->description = 'family';
        $coverage4->save();
    }
}
