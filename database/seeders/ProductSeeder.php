<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($x=0 ;$x<10 ;$x++){
            DB::table('product')->insert([
                'product_name' => "product ".$x,
                 'product_idcode' => "id product ".$x,
                'category_id' => rand(1,5),
                'brand_id' =>rand(1,5) ,
                
                'product_price'=>"200000",
         'product_unit'=>"cái",
                'product_status'=>true,
                'product_SLtrongkho'=> 20
            ]);
        }
    }
}