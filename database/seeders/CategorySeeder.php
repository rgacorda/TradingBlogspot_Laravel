<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array("Long Term", "Short Term", "Intraday", 
                            "Long Ideas", "Short Ideas", "Risk", "Tips",
                            "Psychology", "Secrets");

        foreach($categories as $cats){
            DB::table('cats')->insert([
                'cat_desc'=>$cats
            ]);
        }
        
    }
}
