<?php

use Illuminate\Database\Seeder;
use App\MedicalPlan;

class MedicalPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medical1 = new MedicalPlan();
        $medical1->description = 'ppo preferred';
        $medical1->save();
        $medical1->insuranceCoverage()->sync([
            1 => ['amount' => 35.18],
            2 => ['amount' => 73.87],
            3 => ['amount' => 65.08],
            4 => ['amount' => 114.33],
        ]);
    
        $medical2 = new MedicalPlan();
        $medical2->description = 'ppo non-preferred';
        $medical2->save(); 
        $medical2->insuranceCoverage()->sync([
            1 => ['amount' => 38.70],
            2 => ['amount' => 81.26],
            3 => ['amount' => 71.59],
            4 => ['amount' => 125.76],
        ]);
        
        $medical3 = new MedicalPlan();
        $medical3->description = 'cdhp standard preferred';
        $medical3->save();
        $medical3->insuranceCoverage()->sync([
            1 => ['amount' => 27.85],
            2 => ['amount' => 58.48],
            3 => ['amount' => 51.52],
            4 => ['amount' => 90.51],
        ]);

        $medical4 = new MedicalPlan();
        $medical4->description = 'cdhp standard non-preferred';
        $medical4->save();
        $medical4->insuranceCoverage()->sync([
            1 => ['amount' => 31.19],
            2 => ['amount' => 65.50],
            3 => ['amount' => 57.70],
            4 => ['amount' => 101.37],
        ]);

        $medical5 = new MedicalPlan();
        $medical5->description = 'cdhp buy-down preferred';
        $medical5->save();
        $medical5->insuranceCoverage()->sync([
            1 => ['amount' => 21.11],
            2 => ['amount' => 44.32],
            3 => ['amount' => 39.05],
            4 => ['amount' => 68.60],
        ]);

        $medical6 = new MedicalPlan();
        $medical6->description = 'cdhp buy-down non-preferred';
        $medical6->save();
        $medical6->insuranceCoverage()->sync([
            1 => ['amount' => 24.27],
            2 => ['amount' => 50.97],
            3 => ['amount' => 44.90],
            4 => ['amount' => 78.88],
        ]);
    }
}
