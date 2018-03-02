<?php

use Illuminate\Database\Seeder;
use App\WageProgression;

class WageProgressionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $progression0 = new WageProgression();
        $progression0->month = 0;
        $progression0->save();

        $progression3 = new WageProgression();
        $progression3->month = 3;
        $progression3->save();

        $progression6 = new WageProgression();
        $progression6->month = 6;
        $progression6->save();

        $progression9 = new WageProgression();
        $progression9->month = 9;
        $progression9->save();

        $progression12 = new WageProgression();
        $progression12->month = 12;
        $progression12->save();

        $progression15 = new WageProgression();
        $progression15->month = 15;
        $progression15->save();

        $progression18 = new WageProgression();
        $progression18->month = 18;
        $progression18->save();

        $progression21 = new WageProgression();
        $progression21->month = 21;
        $progression21->save();

        $progression24 = new WageProgression();
        $progression24->month = 24;
        $progression24->save();

        $progression27 = new WageProgression();
        $progression27->month = 27;
        $progression27->save();

        $progression30 = new WageProgression();
        $progression30->month = 30;
        $progression30->save();

        $progression33 = new WageProgression();
        $progression33->month = 33;
        $progression33->save();

        $progression36 = new WageProgression();
        $progression36->month = 36;
        $progression36->save();

        $progression39 = new WageProgression();
        $progression39->month = 39;
        $progression39->save();

        $progression42 = new WageProgression();
        $progression42->month = 42;
        $progression42->save();
    }
}
