<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccountCompanyOrderStatusesTableSeeder::class);
        $this->call(TransactionTypesTableSeeder::class);
        $this->call(ServiceStatusesTableSeeder::class);
        $this->call(OrderStatusesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ModerationStatusesTableSeeder::class);
    }
}
