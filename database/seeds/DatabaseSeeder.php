<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminUserSeeder::class);
    }
}

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(['name' => 'Eric', 'email' => 'eric@admin.ca', 'password' => Hash::make('eric')]);
        User::create(['name' => 'Eric', 'email' => 'eric@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);

    }
}