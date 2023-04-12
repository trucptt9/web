<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($x=0 ;$x<5 ;$x++){
            DB::table('category')->insert([
                'category_name' => "Category ".$x,
                'category_desc' => "mo ta",
                'category_status' => 1,
            ]);
        }
    }
}
