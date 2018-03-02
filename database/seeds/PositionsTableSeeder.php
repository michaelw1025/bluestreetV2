<?php

use Illuminate\Database\Seeder;
use App\Position;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position1 = new Position();
        $position1->description = 'hourly';
        $position1->save();

        $position2 = new Position();
        $position2->description = 'salary';
        $position2->save();
    }
}
