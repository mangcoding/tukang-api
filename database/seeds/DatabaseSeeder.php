<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('RegionalSeeder');
        $this->call('UserSeeder');
        $this->call('AddressSeeder');
        $this->call('CategorySeeder');
        $this->call('ServiceSeeder');
    }
}
