<?php

use Illuminate\Database\Seeder;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\TransactionType::create([
            'name' => 'Покупка'
        ]);
        \App\TransactionType::create([
            'name' => 'Перевод'
        ]);
        \App\TransactionType::create([
            'name' => 'Комбинированная покупка'
        ]);
    }
}
