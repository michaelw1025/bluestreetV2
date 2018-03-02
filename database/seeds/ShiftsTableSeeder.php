<?php

use Illuminate\Database\Seeder;
use App\Shift;

class ShiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shift1 = new Shift();
        $shift1->description = 'day';
        $shift1->save();

        $shift2 = new Shift();
        $shift2->description = 'night';
        $shift2->save();
    }
}
