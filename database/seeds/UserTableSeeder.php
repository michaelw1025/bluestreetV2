<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();
        $role_hruser = Role::where('name', 'hruser')->first();

        $userAdd1 = new User();
        $userAdd1->first_name = 'Mike';
        $userAdd1->last_name = 'Williamson';
        $userAdd1->email = 'mwilliamson@example.com';
        $userAdd1->password = bcrypt('secret');
        $userAdd1->save();
        $userAdd1->role()->attach($role_admin);

        $userAdd2 = new User();
        $userAdd2->first_name = 'Harry';
        $userAdd2->last_name = 'Potter';
        $userAdd2->email = 'hpotter@example.com';
        $userAdd2->password = bcrypt('secret');
        $userAdd2->save();
        $userAdd2->role()->attach($role_user);

        $userAdd3 = new User();
        $userAdd3->first_name = 'Nicole';
        $userAdd3->last_name = 'Williamson';
        $userAdd3->email = 'nwilliamson@example.com';
        $userAdd3->password = bcrypt('secret');
        $userAdd3->save();
        $userAdd3->role()->attach($role_user);

        $userAdd4 = new User();
        $userAdd4->first_name = 'Luke';
        $userAdd4->last_name = 'Skywalker';
        $userAdd4->email = 'lskywalker@example.com';
        $userAdd4->password = bcrypt('secret');
        $userAdd4->save();
        $userAdd4->role()->attach($role_hruser);
    }
}
