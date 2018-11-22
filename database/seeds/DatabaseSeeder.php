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
        Admin::create(['name' => 'Ethan', 'email' => 'ethan@admin.ca', 'password' => Hash::make('ethan')]);

        User::create(['name' => 'Eric', 'email' => 'eric@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);
        User::create(['name' => 'Josh', 'email' => 'josh@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);
        User::create(['name' => 'Ming', 'email' => 'ming@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);
        User::create(['name' => 'Ethan', 'email' => 'ethan@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);
        User::create(['name' => 'Kevin', 'email' => 'kevin@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);
        User::create(['name' => 'Eric2', 'email' => 'eric2@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);
        User::create(['name' => 'Eric3', 'email' => 'eric3@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);
        User::create(['name' => 'Eric4', 'email' => 'eric4@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);
        User::create(['name' => 'Eric5', 'email' => 'eric5@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);
        User::create(['name' => 'Eric6', 'email' => 'eric6@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);
        User::create(['name' => 'Eric7', 'email' => 'eric7@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);
        User::create(['name' => 'Ethan', 'email' => 'ethan2@normie.ca', 'password' => Hash::make('eric'), 'phone' => '1234567890', 'birthday' => '2018-11-06']);
    }
}