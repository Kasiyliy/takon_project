<?php

use Illuminate\Database\Seeder;

class AccountCompanyOrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\AccountCompanyOrderStatus::create([
            'name' => 'Перечислено'
        ]);

        \App\AccountCompanyOrderStatus::create([
            'name' => 'Отменено'
        ]);

        \App\AccountCompanyOrderStatus::create([
            'name' => 'Просрочено'
        ]);
    }
}
