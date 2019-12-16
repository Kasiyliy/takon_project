<?php

use Illuminate\Database\Seeder;

class ModerationStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ModerationStatus::create([
            'name' => 'На модерации'
        ]);

        \App\ModerationStatus::create([
            'name' => 'Одобрено'
        ]);

        \App\ModerationStatus::create([
            'name' => 'Отказано'
        ]);
    }
}
