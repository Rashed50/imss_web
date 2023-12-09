<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Districts')->insert([
            'DistId'=>2,
            'DistName'=>'Gazipur',
            'DiviId'=>1,
        ]);
            
        //
    }
}
