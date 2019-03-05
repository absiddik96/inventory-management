<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(

            'name'      => 'Admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('123456'), //hashes our password nicely for us
            'is_admin'  => 1,

        ));

        User::create(array(

            'name'      => 'Regular User',
            'email'     => 'user@gmail.com',
            'password'  => bcrypt('123456'), //hashes our password nicely for us
            'is_admin'  => 0,

        ));
    }
}
