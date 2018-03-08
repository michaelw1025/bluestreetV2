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

        $vision2 = new VisionPlan();
        $vision2->description = 'discount';
        $vision2->save();
    }
}
