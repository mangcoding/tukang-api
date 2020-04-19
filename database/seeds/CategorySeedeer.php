<?php
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            "name" => "Service Handphone",
            "slug" => "service-handphone",
            "description" => "Service HP",
        );
        DB::table('categories')->insert($categories);
    }
}
