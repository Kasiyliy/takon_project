<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create(
        [
            'username' => 'admin@mail.kz',
            'email' => 'admin@mail.kz',
            'password' => Hash::make('112233'),
            'role_id' => 1
        ]
    );
    }
}
