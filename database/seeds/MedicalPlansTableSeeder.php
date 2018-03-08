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
    
        $medical2 = new MedicalPlan();
        $medical2->description = 'ppo non-preferred';
        $medical2->save(); 
        
        $medical3 = new MedicalPlan();
        $medical3->description = 'cdhp standard preferred';
        $medical3->save();

        $medical4 = new MedicalPlan();
        $medical4->description = 'cdhp standard non-preferred';
        $medical4->save();

        $medical5 = new MedicalPlan();
        $medical5->description = 'cdhp buy-down preferred';
        $medical5->save();

        $medical6 = new MedicalPlan();
        $medical6->description = 'cdhp buy-down non-preferred';
        $medical6->save();
    }
}
