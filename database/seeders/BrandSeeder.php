<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
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
            DB::table('brand')->insert([
                'brand_name' => "Brand ".$x,
                'brand_desc' => "mo ta",
                'brand_status' => 1,
            ]);
        }
        
    }
}
