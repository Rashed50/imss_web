<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Thanas')->insert([
            'ThanId'=>1,
            'ThanName'=>'Mirzapur',
            'DiviId'=>1,
            'DistId'=>1,
            'created_at'=>'08-11-2023',
            'updated_at'=>'09-11-2023',
            
        ]);   
    }
}
