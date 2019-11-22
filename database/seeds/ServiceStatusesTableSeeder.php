<?php

use Illuminate\Database\Seeder;

class ServiceStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ServiceStatus::create([
            'name' => 'В наличии'
        ]);

        \App\ServiceStatus::create([
            'name' => 'Нет в наличии'
        ]);
    }
}
