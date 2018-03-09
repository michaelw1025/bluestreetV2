<?php

use Illuminate\Database\Seeder;
use App\VisionPlan;

class VisionPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vision1 = new VisionPlan();
        $vision1->description = 'enrolled';
        $vision1->save();
        $vision1->insuranceCoverage()->sync([
            1 => ['amount' => 1.17], 
            2 => ['amount' => 2.34], 
            3 => ['amount' => 2.50], 
            4 => ['amount' => 4.00]
        ]);

        $vision2 = new VisionPlan();
        $vision2->description = 'discount';
        $vision2->save();
        $vision2->insuranceCoverage()->sync([
            1 => ['amount' => 0], 
            2 => ['amount' => 0], 
            3 => ['amount' => 0], 
            4 => ['amount' => 0]
        ]);
    }
}
