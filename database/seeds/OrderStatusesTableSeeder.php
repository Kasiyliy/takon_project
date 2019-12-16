<?php

use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\OrderStatus::create([
            'name' => 'В ожидании'
        ]);

        \App\OrderStatus::create([
            'name' => 'Одобрено'
        ]);

        \App\OrderStatus::create([
            'name' => 'Отклонено'
        ]);
    }
}
