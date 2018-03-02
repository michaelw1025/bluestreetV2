<?php

use Illuminate\Database\Seeder;
use App\Team;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentTeams = array('assembly', 'machining', 'materials warehouse', 'single pack warehouse', 'quality', 'cal lab', 'chem team', 'facilities', 'tool room');

        foreach($currentTeams as $currentTeam){
            $team = new Team;
            $team->description = $currentTeam;
            $team->save();
        }
    }
}
