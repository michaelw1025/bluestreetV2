<?php

use Illuminate\Database\Seeder;
use App\Job;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job1 = new Job();
        $job1->description = 'hourly';
        $job1->save();

        $job2 = new Job();
        $job2->description = 'salary';
        $job2->save();
    }
}
