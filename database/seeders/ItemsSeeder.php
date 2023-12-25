<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'CateName' => 'Road' , // 1
              'CateBLName' => 'রড' ,
        ]);

        DB::table('categories')->insert([
            'CateName' => 'Cement', // 2
                'CateBLName' => 'সিমেন্ট' ,
        ]);

        DB::table('categories')->insert([
            'CateName' => 'Tin', // 3
                'CateBLName' => 'টিন' ,
        ]);


         // Cement
         DB::table('brands')->insert([
            'BranName' => 'Holcim' ,
            'BranBlName'=>'Holcim1',
            'CateId' => 1
        ]);
        DB::table('brands')->insert([
            'BranName' => 'OPC' ,
            'BranBlName'=>'OPC1',
            'CateId' => 1
        ]);
        DB::table('brands')->insert([
            'BranName' => 'Bengle' ,
            'BranBlName'=>'Bengle1',
            'CateId' => 1
        ]);

// Rod
        DB::table('brands')->insert([
            'BranName' => 'BSRM' ,
            'BranBlName'=>'BSRM1',
            'CateId' => 2
        ]);
        DB::table('brands')->insert([
            'BranName' => 'PSRM' ,
            'BranBlName'=>'PSRM1',
            'CateId' => 2
        ]);
        DB::table('brands')->insert([
            'BranName' => 'CSRM' ,
            'BranBlName'=>'CSRM1',
            'CateId' => 2
        ]);

// Tin
        DB::table('brands')->insert([
            'BranName' => 'Morgi Marka' ,
            'BranBlName'=>'Morgi Marka1',
            'CateId' => 3
        ]);
        DB::table('brands')->insert([
            'BranName' => 'KY' ,
            'BranBlName'=>'KY1',
            'CateId' => 3
        ]);
        DB::table('brands')->insert([
            'BranName' => 'Horse' ,
            'BranBlName'=>'Horse1',
            'CateId' => 3
        ]);





    // size
        DB::table('sizes')->insert([
            'SizeName' => 'n/a' ,
            'SizeBlName'=>'RT',
            'CateId' => 1,
            'BranId' => 1,
        ]);

        DB::table('sizes')->insert([
            'SizeName' => 'na' ,
            'SizeBlName'=>'na1',
            'CateId' => 1,
            'BranId' => 2,
        ]);

        DB::table('sizes')->insert([
            'SizeName' => 'n/a' ,
            'SizeBlName'=>'RT',
            'CateId' => 1,
            'BranId' => 3,
        ]);

        DB::table('sizes')->insert([
            'SizeName' => 'na' ,
            'SizeBlName'=>'na1',
            'CateId' => 2,
            'BranId' => 4,
        ]);

        DB::table('sizes')->insert([
            'SizeName' => 'na' ,
            'SizeBlName'=>'na1',
            'CateId' => 2,
            'BranId' => 5,
        ]);


        DB::table('sizes')->insert([
            'SizeName' => 'na' ,
            'SizeBlName'=>'na1',
            'CateId' => 2,
            'BranId' => 6,
        ]);







        // thickness

        DB::table('thicknesses')->insert([
            'ThicName' => 'na' ,
            'ThicBlName' => 'na1' ,
            'CateId' => 1,
            'BranId' => 2,
            'SizeId' => 1
        ]);
        DB::table('thicknesses')->insert([
            'ThicName' => 'n/a' ,
            'ThicBlName' => 'RT',
            'CateId' => 1,
            'BranId' => 2,
            'SizeId' => 2
        ]);

    }
}
