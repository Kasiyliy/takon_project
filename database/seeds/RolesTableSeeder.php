<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create([
            'name' => 'Администратор'
        ]);

        \App\Role::create([
            'name' => 'Юридическое лицо/Компания'
        ]);

        \App\Role::create([
            'name' => 'Партнер'
        ]);

        \App\Role::create([
            'name' => 'Клиент'
        ]);

        \App\Role::create([
            'name' => 'Продавец'
        ]);
    }
}
