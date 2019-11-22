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
        \App\AccountCompanyOrderStatus::create([
            'name' => 'В ожидании'
        ]);

        \App\AccountCompanyOrderStatus::create([
            'name' => 'Одобрено'
        ]);
    }
}
