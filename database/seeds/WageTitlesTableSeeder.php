<?php

use Illuminate\Database\Seeder;
use App\WageTitle;

class WageTitlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title1 = new WageTitle();
        $title1->description = 'salary';
        $title1->save();

        $title2 = new WageTitle();
        $title2->description = 'assembly';
        $title2->save();

        $title3 = new WageTitle();
        $title3->description = 'technical';
        $title3->save();

        $title4 = new WageTitle();
        $title4->description = 'specialist';
        $title4->save();

        $title5 = new WageTitle();
        $title5->description = 'maintenance';
        $title5->save();
    }
}
