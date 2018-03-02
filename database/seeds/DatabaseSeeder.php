<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);

        $this->call(CostCentersTableSeeder::class);

        $this->call(JobsTableSeeder::class);

        $this->call(PositionsTableSeeder::class);

        $this->call(ShiftsTableSeeder::class);

        $this->call(TeamsTableSeeder::class);

        $this->call(WageProgressionsTableSeeder::class);

        $this->call(WageTitlesTableSeeder::class);
    }
}
