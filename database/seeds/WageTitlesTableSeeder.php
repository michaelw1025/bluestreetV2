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
        $assemblyAmounts = [
            1 => ['amount' => 11.56],
            2 => ['amount' => 12.06],
            3 => ['amount' => 12.56],
            4 => ['amount' => 13.06],
            5 => ['amount' => 13.56],
            6 => ['amount' => 14.06],
            7 => ['amount' => 14.56],
            8 => ['amount' => 14.56],
            9 => ['amount' => 14.56],
            10 => ['amount' => 14.56],
            11 => ['amount' => 14.56],
            12 => ['amount' => 14.56],
            13 => ['amount' => 14.56],
            14 => ['amount' => 14.56],
            15 => ['amount' => 14.56],
        ];
        $technicalAmounts = [
            1 => ['amount' => 11.56],
            2 => ['amount' => 12.09],
            3 => ['amount' => 12.62],
            4 => ['amount' => 13.15],
            5 => ['amount' => 13.68],
            6 => ['amount' => 14.21],
            7 => ['amount' => 14.74],
            8 => ['amount' => 15.27],
            9 => ['amount' => 15.27],
            10 => ['amount' => 15.27],
            11 => ['amount' => 15.27],
            12 => ['amount' => 15.27],
            13 => ['amount' => 15.27],
            14 => ['amount' => 15.27],
            15 => ['amount' => 15.27],
        ];
        $specialistAmounts = [
            1 => ['amount' => 13.77],
            2 => ['amount' => 14.18],
            3 => ['amount' => 14.57],
            4 => ['amount' => 14.92],
            5 => ['amount' => 15.31],
            6 => ['amount' => 15.71],
            7 => ['amount' => 16.10],
            8 => ['amount' => 16.44],
            9 => ['amount' => 17.38],
            10 => ['amount' => 17.81],
            11 => ['amount' => 18.40],
            12 => ['amount' => 18.40],
            13 => ['amount' => 18.40],
            14 => ['amount' => 18.40],
            15 => ['amount' => 18.40],
        ];
        $maintenanceAmounts = [
            1 => ['amount' => 19.65],
            2 => ['amount' => 20.04],
            3 => ['amount' => 20.36],
            4 => ['amount' => 20.78],
            5 => ['amount' => 21.14],
            6 => ['amount' => 21.43],
            7 => ['amount' => 21.74],
            8 => ['amount' => 22.05],
            9 => ['amount' => 22.32],
            10 => ['amount' => 22.60],
            11 => ['amount' => 22.91],
            12 => ['amount' => 23.25],
            13 => ['amount' => 24.59],
            14 => ['amount' => 25.21],
            15 => ['amount' => 26.07],
        ];
        $salaryAmounts = [
            1 => ['amount' => 0],
            2 => ['amount' => 0],
            3 => ['amount' => 0],
            4 => ['amount' => 0],
            5 => ['amount' => 0],
            6 => ['amount' => 0],
            7 => ['amount' => 0],
            8 => ['amount' => 0],
            9 => ['amount' => 0],
            10 => ['amount' => 0],
            11 => ['amount' => 0],
            12 => ['amount' => 0],
            13 => ['amount' => 0],
            14 => ['amount' => 0],
            15 => ['amount' => 0],
        ];

        // DB::table('wage_titles')->truncate();
        // DB::table('wage_progression_wage_title')->truncate();


        $title1 = new WageTitle();
        $title1->description = 'salary';
        $title1->save();
        $title1->wageProgression()->sync($salaryAmounts);

        $title2 = new WageTitle();
        $title2->description = 'assembly';
        $title2->save();
        $title2->wageProgression()->sync($assemblyAmounts);

        $title3 = new WageTitle();
        $title3->description = 'technical';
        $title3->save();
        $title3->wageProgression()->sync($technicalAmounts);

        $title4 = new WageTitle();
        $title4->description = 'specialist';
        $title4->save();
        $title4->wageProgression()->sync($specialistAmounts);

        $title5 = new WageTitle();
        $title5->description = 'maintenance';
        $title5->save();
        $title5->wageProgression()->sync($maintenanceAmounts);
    }
}
