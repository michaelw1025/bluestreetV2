<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_1 = new Role();
        $role_1->name = 'user';
        $role_1->description = 'general access';
        $role_1->save();

        $role_2 = new Role();
        $role_2->name = 'admin';
        $role_2->description = 'site admins';
        $role_2->save();

        $role_3 = new Role();
        $role_3->name = 'hrmanager';
        $role_3->description = 'human resources managers';
        $role_3->save();

        $role_4 = new Role();
        $role_4->name = 'hruser';
        $role_4->description = 'human resources users';
        $role_4->save();

        $role_5 = new Role();
        $role_5->name = 'hrassistant';
        $role_5->description = 'human resources assistants';
        $role_5->save();
    }
}
