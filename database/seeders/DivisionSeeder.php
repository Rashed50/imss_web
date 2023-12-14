<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

                DB::table('divisions')->insert([ // step 02
                   'DiviId' => 1,
                   'DiviName' => 'Khulna',
                 ]);

                 DB::table('districts')->insert([ // step 02
                  'DistId' => 1,
                  'DistName' => 'Meherpur',
                  'DiviId' => 1,
                ]);

                DB::table('thanas')->insert([ // step 02
                  'ThanId'=> 1,
                  'ThanaName' => 'Meherpur Sadar',
                  'DistId' => 1,
                  'DiviId' => 1,
                ]);

                DB::table('unions')->insert([ // step 02
                  'UnioId'=> 1,
                  'UnioName' => 'ABC',
                  'ThanId'=> 1,
                  'DistId' => 1,
                  'DiviId' => 1,
                ]);
    }
}
